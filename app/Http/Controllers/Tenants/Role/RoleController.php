<?php

namespace App\Http\Controllers\Tenants\Role;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(RevalidateBackHistory::class);
        $this->middleware('permission:roles_view', [
            'only' => 'index'
        ]);
        $this->middleware('permission:roles_edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:roles_delete', [
            'only' => ['destroy']
        ]);

        $this->middleware('permission:roles_restored', [
            'only' => ['restoreUser']
        ]);
        $this->middleware('permission:roles_force_delete', [
            'only' => ['deletePermanently']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withTrashed()->get();
        return view('tenants.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());
        return to_route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('tenants.roles.edit', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('tenants.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        return view('tenants.roles.edit', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->destroy($role->id);
        // $user->save();
        return to_route('roles.index');
    }


    public function restoreUser($id)
    {

        $record = Role::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post

        return to_route('roles.index');
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = Role::withTrashed()->find($id);
        $record->forceDelete();
        return to_route('roles.index');
    }
}