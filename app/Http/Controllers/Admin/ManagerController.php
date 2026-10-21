<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerRequest;
use App\Models\Manager;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {

        $managerList = Manager::orderBy('id', 'DESC')->get();
        return view('layouts.backend.pages.admin.manager.index', compact('managerList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('layouts.backend.pages.admin.manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ManagerRequest $request
     * @return void
     */
    public function store(ManagerRequest $request)
    {
        $newManager = new Manager();
        $newManager->name = $request->input('name');
        $operationStatus = $newManager->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Manager name successfully added.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.manager.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.manager.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManagerRequest $request
     * @param  int $id
     * @return Factory|RedirectResponse|View
     */
    public function edit(ManagerRequest $request, $id)
    {
        $manager = Manager::find($id);
        if (isset($manager)) {
            return view('layouts.backend.pages.admin.manager.edit', compact('manager'));
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.manager.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ManagerRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(ManagerRequest $request, $id)
    {
        $updateManager = Manager::find($id);
        if (isset($updateManager)) {

            $updateManager->name = $request->input('name');
            $operationStatus = $updateManager->save();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Manager name successfully updated.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.manager.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.manager.edit', $id)->withInput();
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.manager.edit', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagerRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(ManagerRequest $request, $id)
    {
        $manager = Manager::find($id);
        if (isset($manager)) {

            $operationStatus = $manager->delete();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Manager successfully deleted.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.manager.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.manager.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.manager.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return Response
     */

    public function showDeleted()
    {
        $managerList = Manager::onlyTrashed()->get();
        return view('layouts.backend.pages.admin.manager.deleted', compact('managerList'));
    }

    /**
     * Restore the selected resource
     *
     * @param ManagerRequest $request
     * @param $id
     * @return RedirectResponse
     */

    public function restoreDeleted(ManagerRequest $request, $id)
    {

        $manager = Manager::withTrashed()->find($id);
        if (isset($manager)) {

            $operationStatus = $manager->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Manager successfully restored.');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.manager.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.manager.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.manager.deleted.show');
        }
    }
}
