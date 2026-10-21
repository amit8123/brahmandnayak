<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Methods\Methods;
use App\Http\Requests\AccountsRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {

        $accountList = User::with('roleDetail')->has('roleDetail')->get();
        return view('layouts.backend.pages.admin.accounts.index', compact('accountList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $encryptKey = Crypt::generateKey('AES-128-CBC');
        $base64Key = base64_encode($encryptKey);
        $request->session()->put('key', $base64Key);
        $roles = Role::all();
        return view('layouts.backend.pages.admin.accounts.create', compact('roles', 'base64Key'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountsRequest $request
     * @return void
     */
    public function store(AccountsRequest $request)
    {
        $newAccount = new User();
        $newAccount->name = $request->input('name');
        $newAccount->email = $request->input('email');
        $newAccount->mobile = $request->input('mobile');
        $newAccount->password = bcrypt($request->input('password'));
        $newAccount->role = $request->input('role');
        $newAccount->active = true;
        $operationStatus = $newAccount->save();
        if ($operationStatus) {
            $request->session()->flash('flash_notification.message', 'Account successfully added.');
            $request->session()->flash('flash_notification.level', 'success');
            return redirect()->route('admin.accounts.index');
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later.');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.accounts.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DepartmentRequest $request
     * @param  int $id
     * @return Factory|RedirectResponse|View
     */
    public function edit(AccountsRequest $request, $id)
    {
        $account = User::find($id);
        if (isset($account)) {
            $encryptKey = Crypt::generateKey('AES-128-CBC');
            $base64Key = base64_encode($encryptKey);
            $request->session()->put('key', $base64Key);
            $roles = Role::all();
            return view('layouts.backend.pages.admin.accounts.edit', compact('account', 'roles', 'base64Key'));
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.accounts.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(AccountsRequest $request, $id)
    {
        $updateAccount = User::find($id);
        if (isset($updateAccount)) {

            $updateAccount->name = $request->input('name');
            $updateAccount->email = $request->input('email');
            $updateAccount->mobile = $request->input('mobile');
            $updateAccount->role = $request->input('role');

            $password = $request->input('password');
            if (isset($password)) {
                $updateAccount->password = bcrypt($request->input('password'));
            }
            $updateAccount->role = $request->input('role');
            $operationStatus = $updateAccount->save();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Account successfully updated. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.accounts.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.accounts.edit', $id)->withInput();
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.accounts.edit', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DepartmentRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(AccountsRequest $request, $id)
    {
        $account = User::find($id);
        if (isset($account)) {

            $operationStatus = $account->delete();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Account successfully deleted. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.accounts.index');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.accounts.index');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.accounts.index');
        }
    }

    /**
     * Display the deleted resources
     *
     * @return Response
     */

    public function showDeleted()
    {
        $accountList = User::onlyTrashed()->with('roleDetail')->has('roleDetail')->get();
        return view('layouts.backend.pages.admin.accounts.deleted', compact('accountList'));
    }

    /**
     * Restore the selected resource
     *
     * @param DepartmentRequest $request
     * @param $id
     * @return RedirectResponse
     */

    public function restoreDeleted(AccountsRequest $request, $id)
    {

        $account = User::withTrashed()->find($id);
        if (isset($account)) {

            $operationStatus = $account->restore();

            if ($operationStatus) {
                $request->session()->flash('flash_notification.message', 'Account successfully restored. ');
                $request->session()->flash('flash_notification.level', 'success');
                return redirect()->route('admin.accounts.deleted.show');
            } else {
                $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
                $request->session()->flash('flash_notification.level', 'danger');
                return redirect()->route('admin.accounts.deleted.show');
            }
        } else {
            $request->session()->flash('flash_notification.message', 'An error occurred, please try again later. ');
            $request->session()->flash('flash_notification.level', 'danger');
            return redirect()->route('admin.accounts.deleted.show');
        }
    }
}
