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

        $this->middleware('permission:roles_restore', [
            'only' => ['restoreUser']
        ]);
        $this->middleware('permission:roles_force_delete', [
            'only' => ['deletePermanently']
        ]);
        $this->middleware('permission:permissions_create', [
            'only' => ['create', 'store']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles = Role::withTrashed()->paginate(config('app.per_page'));
        if ($roles->lastPage() >= request('page')) {
            return view('tenants.roles.index', compact('roles'));
        }
        return to_route('roles.index', ['page' => request('page')]);
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
        session()->flash('message', __('role.message.save-message'));
        session()->flash('error', 'success');
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
        $oldrole = $role;
        $role->update($data);
        session()->flash('message', __('role.message.update-message'));
        session()->flash('error', 'success');
        return to_route('roles.edit', [$oldrole->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->destroy($role->id);

        session()->flash('message', __('role.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('roles.index', ['page' => request('page')]);
    }


    public function restoreUser($id)
    {

        $record = Role::withTrashed()->find($id);

        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('role.message.restore-message'));
        session()->flash('error', 'success');
        return to_route('roles.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = Role::withTrashed()->find($id);
        $record->forceDelete();
        session()->flash('message', __('role.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('roles.index', ['page' => request('page')]);
    }
}
