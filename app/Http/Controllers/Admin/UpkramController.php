<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpkramRequest;
use App\Models\Upkram;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UpkramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {

        $upkramList = Upkram::orderBy('id', 'DESC')->get();
        return view('layouts.backend.pages.admin.upkram.index', compact('upkramList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('layouts.backend.pages.admin.upkram.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpkramRequest $request
     * @return void
     */
    public function store(UpkramRequest $request)
    {
        $newUpkram = new Upkram();
        $newUpkram->icon = $request->input('icon');
        $newUpkram->bg_color = $request->input('bg-color');
        $newUpkram->title = $request->input('title');
        $newUpkram->mohim_body = $request->input('mohim-body');
        $operationStatus = $newUpkram->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Upkram successfully added.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.upkram.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.upkram.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UpkramRequest $request
     * @param  int $id
     * @return Factory|RedirectResponse|View
     */
    public function edit(UpkramRequest $request, $id)
    {
        $upkram = Upkram::find($id);
        if (isset($upkram)) {
            return view('layouts.backend.pages.admin.upkram.edit', compact('upkram'));
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.upkram.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpkramRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(UpkramRequest $request, $id)
    {
        $updateUpkram = Upkram::find($id);
        if (isset($updateUpkram)) {

            $updateUpkram->icon = $request->input('icon');
            $updateUpkram->bg_color = $request->input('bg-color');
            $updateUpkram->title = $request->input('title');
            $updateUpkram->mohim_body = $request->input('mohim-body');
            $operationStatus = $updateUpkram->save();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Upkram successfully updated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.upkram.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.upkram.edit', $id)->withInput();
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.upkram.edit', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UpkramRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(UpkramRequest $request, $id)
    {
        $upkram = Upkram::find($id);
        if (isset($upkram)) {

            $operationStatus = $upkram->delete();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Upkram successfully deleted. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.upkram.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.upkram.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.upkram.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return Response
     */

    public function showDeleted()
    {
        $upkramList = Upkram::onlyTrashed()->get();
        return view('layouts.backend.pages.admin.upkram.deleted', compact('upkramList'));
    }

    /**
     * Restore the selected resource
     *
     * @param UpkramRequest $request
     * @param $id
     * @return RedirectResponse
     */

    public function restoreDeleted(UpkramRequest $request, $id)
    {

        $upkram = Upkram::withTrashed()->find($id);
        if (isset($upkram)) {

            $operationStatus = $upkram->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Upkram successfully restored. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.upkram.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.upkram.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.upkram.deleted.show');
        }
    }
}
