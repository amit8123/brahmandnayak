<?php

namespace App\Services;

use RuntimeException;
use XMLReader;
use ZipArchive;

/**
 * Small dependency-free reader for .xlsx and .csv files.
 * Streams rows one at a time so a few thousand rows use very little memory.
 */
class SpreadsheetReader
{
    /**
     * Yield every row of the first worksheet as a 0-indexed array of strings.
     *
     * @param string $path      real path of the uploaded file
     * @param string $extension lower-case extension (xlsx|csv|txt)
     * @return \Generator
     */
    public static function rows($path, $extension)
    {
        $extension = strtolower($extension);

        if ($extension === 'xlsx') {
            yield from self::xlsxRows($path);
            return;
        }

        if (in_array($extension, ['csv', 'txt'], true)) {
            yield from self::csvRows($path);
            return;
        }

        throw new RuntimeException('Unsupported file type. Please upload .xlsx or .csv');
    }

    private static function csvRows($path)
    {
        $handle = fopen($path, 'r');
        if ($handle === false) {
            throw new RuntimeException('Unable to read the uploaded file.');
        }

        // detect and drop a UTF-8 BOM, then detect the delimiter from the first line
        $first = fgets($handle);
        if ($first === false) {
            fclose($handle);
            return;
        }
        $first = preg_replace('/^\xEF\xBB\xBF/', '', $first);
        $delimiter = ',';
        $best = substr_count($first, ',');
        foreach ([';', "\t", '|'] as $candidate) {
            $count = substr_count($first, $candidate);
            if ($count > $best) {
                $best = $count;
                $delimiter = $candidate;
            }
        }

        yield str_getcsv($first, $delimiter);
        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            yield $row;
        }
        fclose($handle);
    }

    private static function xlsxRows($path)
    {
        $zip = new ZipArchive();
        if ($zip->open($path) !== true) {
            throw new RuntimeException('This does not look like a valid .xlsx file.');
        }

        $sheetPath = self::firstSheetPath($zip);
        $shared = self::sharedStrings($zip);
        $zip->close();

        $reader = new XMLReader();
        if (!$reader->open('zip://' . $path . '#' . $sheetPath)) {
            throw new RuntimeException('Unable to open the worksheet inside the file.');
        }

        $row = null;
        while ($reader->read()) {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'row') {
                $row = [];
                $expected = 0;
            } elseif ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'c' && $row !== null) {
                $ref = $reader->getAttribute('r');
                $type = $reader->getAttribute('t');
                $col = $ref !== null ? self::columnIndex($ref) : $expected;
                $value = '';

                if (!$reader->isEmptyElement) {
                    $depth = $reader->depth;
                    while ($reader->read()) {
                        if ($reader->nodeType === XMLReader::END_ELEMENT && $reader->depth === $depth) {
                            break;
                        }
                        if ($reader->nodeType === XMLReader::ELEMENT) {
                            if ($reader->name === 'v') {
                                $value = $reader->readString();
                            } elseif ($reader->name === 't') {
                                // inline string
                                $value .= $reader->readString();
                            }
                        }
                    }
                }

                if ($type === 's') {
                    $value = $shared[(int) $value] ?? '';
                }

                while ($expected < $col) {
                    $row[$expected++] = '';
                }
                $row[$col] = $value;
                $expected = $col + 1;
            } elseif ($reader->nodeType === XMLReader::END_ELEMENT && $reader->name === 'row' && $row !== null) {
                yield $row;
                $row = null;
            }
        }
        $reader->close();
    }

    private static function firstSheetPath(ZipArchive $zip)
    {
        if ($zip->locateName('xl/worksheets/sheet1.xml') !== false) {
            return 'xl/worksheets/sheet1.xml';
        }
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);
            if (preg_match('#^xl/worksheets/[^/]+\.xml$#', $name)) {
                return $name;
            }
        }
        throw new RuntimeException('No worksheet found in the file.');
    }

    private static function sharedStrings(ZipArchive $zip)
    {
        $strings = [];
        $xml = $zip->getFromName('xl/sharedStrings.xml');
        if ($xml === false) {
            return $strings;
        }

        $reader = new XMLReader();
        $reader->XML($xml);
        while ($reader->read()) {
            if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'si') {
                $text = '';
                $depth = $reader->depth;
                if (!$reader->isEmptyElement) {
                    while ($reader->read()) {
                        if ($reader->nodeType === XMLReader::END_ELEMENT && $reader->name === 'si' && $reader->depth === $depth) {
                            break;
                        }
                        if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 't') {
                            $text .= $reader->readString();
                        }
                    }
                }
                $strings[] = $text;
            }
        }
        $reader->close();

        return $strings;
    }

    /** "AB12" -> 27 (zero based) */
    private static function columnIndex($ref)
    {
        $letters = preg_replace('/[^A-Z]/i', '', $ref);
        $index = 0;
        foreach (str_split(strtoupper($letters)) as $char) {
            $index = $index * 26 + (ord($char) - 64);
        }
        return $index - 1;
    }
}
