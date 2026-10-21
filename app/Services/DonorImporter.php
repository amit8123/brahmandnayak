<?php

namespace App\Services;

use App\Models\DonorList;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Imports donor rows from a spreadsheet into the donor_lists table.
 */
class DonorImporter
{
    const CHUNK = 500;
    const MAX_ERRORS_SHOWN = 15;

    /** normalised header text => database column */
    private static $aliases = [
        'date' => 'date', 'donationdate' => 'date', 'dt' => 'date', 'दिनांक' => 'date', 'तारीख' => 'date',
        'name' => 'name', 'donor' => 'name', 'donorname' => 'name', 'fullname' => 'name', 'नाव' => 'name',
        'email' => 'email', 'emailid' => 'email', 'emailaddress' => 'email', 'mail' => 'email',
        'amount' => 'amount', 'amt' => 'amount', 'rs' => 'amount', 'rupees' => 'amount', 'रक्कम' => 'amount',
        'transactionid' => 'transaction_id', 'transaction' => 'transaction_id', 'txnid' => 'transaction_id',
        'txn' => 'transaction_id', 'utr' => 'transaction_id', 'utrno' => 'transaction_id',
        'referenceno' => 'transaction_id', 'refno' => 'transaction_id', 'reference' => 'transaction_id',
        'remark' => 'remark', 'remarks' => 'remark', 'note' => 'remark', 'notes' => 'remark', 'शेरा' => 'remark',
    ];

    private static $positional = ['date', 'name', 'email', 'amount', 'transaction_id', 'remark'];

    /**
     * @return array{total:int,inserted:int,duplicates:int,failed:int,errors:array}
     */
    public static function import($path, $extension, $skipDuplicates = true)
    {
        $result = ['total' => 0, 'inserted' => 0, 'duplicates' => 0, 'failed' => 0, 'errors' => []];

        $seen = [];
        if ($skipDuplicates) {
            DonorList::withTrashed()->where('transaction_id', '!=', '')
                ->pluck('transaction_id')
                ->each(function ($id) use (&$seen) {
                    $seen[mb_strtolower($id)] = true;
                });
        }

        $map = null;       // column index => db column
        $batch = [];
        $rowNumber = 0;
        $now = Carbon::now();

        DB::beginTransaction();
        try {
            foreach (SpreadsheetReader::rows($path, $extension) as $raw) {
                $rowNumber++;

                if (self::isBlank($raw)) {
                    continue;
                }

                if ($map === null) {
                    $map = self::detectHeader($raw);
                    if ($map['isHeader']) {
                        $map = $map['map'];
                        continue; // header row consumed
                    }
                    $map = $map['map']; // positional, this row is data
                }

                $result['total']++;
                $data = [];
                foreach ($map as $index => $column) {
                    $data[$column] = isset($raw[$index]) ? trim((string) $raw[$index]) : '';
                }

                $name = $data['name'] ?? '';
                $amount = self::cleanAmount($data['amount'] ?? '');
                if ($name === '' || $amount === '') {
                    $result['failed']++;
                    self::addError($result, $rowNumber, $name === '' ? 'Name is missing' : 'Amount is missing');
                    continue;
                }

                $txn = $data['transaction_id'] ?? '';
                if ($skipDuplicates && $txn !== '') {
                    $key = mb_strtolower($txn);
                    if (isset($seen[$key])) {
                        $result['duplicates']++;
                        continue;
                    }
                    $seen[$key] = true;
                }

                $email = $data['email'] ?? '';
                if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $email = '';
                }

                $batch[] = [
                    'date' => self::parseDate($data['date'] ?? ''),
                    'name' => mb_substr($name, 0, 255),
                    'email' => mb_substr($email, 0, 255),
                    'amount' => $amount,
                    'transaction_id' => mb_substr($txn, 0, 255),
                    'remark' => ($data['remark'] ?? '') !== '' ? $data['remark'] : null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                if (count($batch) >= self::CHUNK) {
                    DonorList::insert($batch);
                    $result['inserted'] += count($batch);
                    $batch = [];
                }
            }

            if ($batch) {
                DonorList::insert($batch);
                $result['inserted'] += count($batch);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $result;
    }

    private static function isBlank(array $row)
    {
        foreach ($row as $cell) {
            if (trim((string) $cell) !== '') {
                return false;
            }
        }
        return true;
    }

    private static function normalise($text)
    {
        $text = mb_strtolower(trim((string) $text));
        return preg_replace('/[^\p{L}\p{M}\p{N}]+/u', '', $text);
    }

    /** @return array{isHeader:bool,map:array} */
    private static function detectHeader(array $row)
    {
        $map = [];
        foreach ($row as $index => $cell) {
            $key = self::normalise($cell);
            if ($key !== '' && isset(self::$aliases[$key]) && !in_array(self::$aliases[$key], $map, true)) {
                $map[$index] = self::$aliases[$key];
            }
        }

        if (count($map) >= 2) {
            return ['isHeader' => true, 'map' => $map];
        }

        return ['isHeader' => false, 'map' => self::$positional];
    }

    private static function cleanAmount($value)
    {
        $value = trim(str_replace([',', '₹', 'Rs.', 'Rs', 'INR', ' '], '', (string) $value));
        if ($value === '' || !is_numeric($value)) {
            return '';
        }
        // 500.0 -> 500, 1500.50 stays
        return rtrim(rtrim(number_format((float) $value, 2, '.', ''), '0'), '.');
    }

    private static function parseDate($value)
    {
        $value = trim((string) $value);
        if ($value === '') {
            return Carbon::today()->toDateString();
        }

        // Excel serial number
        if (is_numeric($value) && $value > 20000 && $value < 100000) {
            return Carbon::create(1899, 12, 30)->addDays((int) $value)->toDateString();
        }

        foreach (['d-m-Y', 'd/m/Y', 'd.m.Y', 'Y-m-d', 'Y/m/d', 'd-m-y', 'd/m/y', 'd M Y', 'd-M-Y'] as $format) {
            try {
                $date = Carbon::createFromFormat('!' . $format, $value);
                if ($date && $date->format($format) === $value) {
                    return $date->toDateString();
                }
            } catch (\Throwable $e) {
                // try the next format
            }
        }

        try {
            return Carbon::parse($value)->toDateString();
        } catch (\Throwable $e) {
            return Carbon::today()->toDateString();
        }
    }

    private static function addError(array &$result, $rowNumber, $reason)
    {
        if (count($result['errors']) < self::MAX_ERRORS_SHOWN) {
            $result['errors'][] = "Row {$rowNumber}: {$reason}";
        }
    }
}
