<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $rolesList = Role::orderBy('id', 'desc')->get();
        return view('layouts.backend.pages.admin.roles.index', compact('rolesList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('layouts.backend.pages.admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $newRoles = new Role();
        $newRoles->created_by = Auth::user()->id;
        $newRoles->name = $request->input('name');
        $operationStatus = $newRoles->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Role successfully added.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.roles.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.roles.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return Factory|RedirectResponse|View
     */
    public function edit(Request $request, $id)
    {
        $roles = Role::find($id);
        if (isset($roles)) {
            return view('layouts.backend.pages.admin.roles.edit', compact('roles'));
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.roles.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $roles = Role::find($id);
        if (isset($roles)) {

            $roles->name = $request->input('name');
            $operationStatus = $roles->save();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Role successfully updated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.roles.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.roles.edit', $id)->withInput();
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.roles.edit', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $roles = Role::find($id);
        if (isset($roles)) {

            $operationStatus = $roles->delete();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Role successfully deleted. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.roles.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.roles.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.roles.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return Factory|View
     */

    public function showDeleted()
    {
        $rolesList = Role::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('layouts.backend.pages.admin.roles.deleted', compact('rolesList'));
    }

    /**
     * Restore the selected resource
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */

    public function restoreDeleted(Request $request, $id)
    {

        $roles = Role::onlyTrashed()->find($id);
        if (isset($roles)) {

            $operationStatus = $roles->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Role successfully restored. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.roles.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.roles.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.roles.deleted.show');
        }
    }
}
