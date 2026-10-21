<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrustyRequest;
use App\Models\Trusty;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TrustyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {

        $trustyList = Trusty::orderBy('id', 'DESC')->get();
        return view('layouts.backend.pages.admin.trusty.index', compact('trustyList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('layouts.backend.pages.admin.trusty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TrustyRequest $request
     * @return void
     */
    public function store(TrustyRequest $request)
    {
        $newTrusty = new Trusty();
        $newTrusty->name = $request->input('name');
        $operationStatus = $newTrusty->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Trusty name successfully added.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.trusty.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.trusty.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TrustyRequest $request
     * @param  int $id
     * @return Factory|RedirectResponse|View
     */
    public function edit(TrustyRequest $request, $id)
    {
        $trusty = Trusty::find($id);
        if (isset($trusty)) {
            return view('layouts.backend.pages.admin.trusty.edit', compact('trusty'));
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.trusty.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TrustyRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(TrustyRequest $request, $id)
    {
        $updateTrusty = Trusty::find($id);
        if (isset($updateTrusty)) {

            $updateTrusty->name = $request->input('name');
            $operationStatus = $updateTrusty->save();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Trusty name successfully updated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.trusty.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.trusty.edit', $id)->withInput();
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.trusty.edit', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TrustyRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(TrustyRequest $request, $id)
    {
        $trusty = Trusty::find($id);
        if (isset($trusty)) {

            $operationStatus = $trusty->delete();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Trusty successfully deleted.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.trusty.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.trusty.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.trusty.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return Response
     */

    public function showDeleted()
    {
        $trustyList = Trusty::onlyTrashed()->get();
        return view('layouts.backend.pages.admin.trusty.deleted', compact('trustyList'));
    }

    /**
     * Restore the selected resource
     *
     * @param TrustyRequest $request
     * @param $id
     * @return RedirectResponse
     */

    public function restoreDeleted(TrustyRequest $request, $id)
    {

        $trusty = Trusty::withTrashed()->find($id);
        if (isset($trusty)) {

            $operationStatus = $trusty->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Trusty successfully restored.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.trusty.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.trusty.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.trusty.deleted.show');
        }
    }
}
