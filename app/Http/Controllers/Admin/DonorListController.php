<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\DonorListRequest;
use App\Models\DonorList;
use App\Services\DonorImporter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DonorListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {

        $donorList = DonorList::orderBy('id', 'DESC')->get();
        return view('layouts.backend.pages.admin.donorList.index', compact('donorList'));
    }

    /**
     * Import donors from an uploaded .xlsx / .csv file.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480',
        ], [
            'file.required' => 'Please choose or drop an Excel (.xlsx) or CSV file.',
            'file.max' => 'The file is too large (maximum 20 MB).',
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, ['xlsx', 'csv', 'txt'], true)) {
            return redirect()->route('admin.donorList.index')
                ->withErrors(['file' => 'Only .xlsx or .csv files are supported. (Old .xls: please "Save As" .xlsx)']);
        }

        @set_time_limit(300);

        try {
            $result = DonorImporter::import(
                $file->getRealPath(),
                $extension,
                $request->has('skip_duplicates')
            );
        } catch (\Throwable $e) {
            return redirect()->route('admin.donorList.index')
                ->withErrors(['file' => 'Import failed, nothing was saved: ' . $e->getMessage()]);
        }

        $message = "Import finished: {$result['inserted']} donors added"
            . ($result['duplicates'] ? ", {$result['duplicates']} duplicates skipped" : '')
            . ($result['failed'] ? ", {$result['failed']} rows had problems" : '')
            . " (out of {$result['total']} rows).";

        $request->session()->flash('flash_notification.message', $message);
        $request->session()->flash('flash_notification.level', $result['inserted'] > 0 ? 'success' : 'warning');
        if ($result['errors']) {
            $request->session()->flash('import_errors', $result['errors']);
        }

        return redirect()->route('admin.donorList.index');
    }

    /**
     * Download a sample sheet showing the expected columns.
     */
    public function importTemplate()
    {
        $rows = [
            ['date', 'name', 'email', 'amount', 'transaction_id', 'remark'],
            ['2024-01-15', 'Ramesh Patil', 'ramesh@example.com', '1100', 'UPI123456789', 'Annadan'],
            ['16-01-2024', 'Sunita Sharma', '', '501', 'UPI987654321', ''],
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM so Excel reads Marathi text correctly
            foreach ($rows as $row) {
                fputcsv($out, $row);
            }
            fclose($out);
        };

        return response()->streamDownload($callback, 'donor-import-template.csv', ['Content-Type' => 'text/csv']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('layouts.backend.pages.admin.donorList.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DonorListRequest $request
     * @return void
     */
    public function store(DonorListRequest $request)
    {
        $newDonorList = new DonorList();
        $newDonorList->date = $request->input('date');
        $newDonorList->name = $request->input('name');
        $newDonorList->email = $request->input('email');
        $newDonorList->amount = $request->input('amount');
        $newDonorList->transaction_id = $request->input('transaction_id');
        $newDonorList->remark = $request->input('remark');
        $operationStatus = $newDonorList->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Donor successfully added.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.donorList.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.donorList.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DonorListRequest $request
     * @return void
     */
    public function storeFrontForm(DonorListRequest $request)
    {
        $newDonorList = new DonorList();
        $newDonorList->date = $request->input('date');
        $newDonorList->name = $request->input('name');
        $newDonorList->email = $request->input('email');
        $newDonorList->amount = $request->input('amount');
        $newDonorList->transaction_id = $request->input('transaction_id');
        $newDonorList->remark = $request->input('remark');
        $operationStatus = $newDonorList->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Your form has been submitted successfully. Thank You!');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('donation');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('donation');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DonorListRequest $request
     * @param  int $id
     * @return Factory|RedirectResponse|View
     */
    public function edit(DonorListRequest $request, $id)
    {
        $donorList = DonorList::find($id);
        if (isset($donorList)) {
            return view('layouts.backend.pages.admin.donorList.edit', compact('donorList'));
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.donorList.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DonorListRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(DonorListRequest $request, $id)
    {
        $updateDonorList = DonorList::find($id);
        if (isset($updateDonorList)) {

            $updateDonorList->date = $request->input('date');
            $updateDonorList->name = $request->input('name');
            $updateDonorList->email = $request->input('email');
            $updateDonorList->amount = $request->input('amount');
            $updateDonorList->transaction_id = $request->input('transaction_id');
            $updateDonorList->remark = $request->input('remark');
            $operationStatus = $updateDonorList->save();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Donor successfully updated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.donorList.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.donorList.edit', $id)->withInput();
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.donorList.edit', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DonorListRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(DonorListRequest $request, $id)
    {
        $donorList = DonorList::find($id);
        if (isset($donorList)) {

            $operationStatus = $donorList->delete();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Donor successfully deleted.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.donorList.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.donorList.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.donorList.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return Response
     */

    public function showDeleted()
    {
        $donorList = DonorList::onlyTrashed()->get();
        return view('layouts.backend.pages.admin.donorList.deleted', compact('donorList'));
    }

    /**
     * Restore the selected resource
     *
     * @param DonorListRequest $request
     * @param $id
     * @return RedirectResponse
     */

    public function restoreDeleted(DonorListRequest $request, $id)
    {

        $donorList = DonorList::withTrashed()->find($id);
        if (isset($donorList)) {

            $operationStatus = $donorList->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Donor successfully restored.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.donorList.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.donorList.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.donorList.deleted.show');
        }
    }
}
