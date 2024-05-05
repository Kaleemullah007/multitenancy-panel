<?php

namespace App\Http\Controllers\Tenants\Permission;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(RevalidateBackHistory::class);

        $this->middleware('permission:permissions_view', [
            'only' => 'index'
        ]);
        $this->middleware('permission:permissions_edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:permissions_delete', [
            'only' => ['destroy']
        ]);

        $this->middleware('permission:permissions_restore', [
            'only' => ['restoreUser']
        ]);
        $this->middleware('permission:permissions_force_delete', [
            'only' => ['deletePermanently']
        ]);
        $this->middleware('permission:permissions_create', [
            'only' => ['create', 'store']
        ]);
    }

    public function index()
    {
        $permissions = Permission::withTrashed()->paginate(config('app.per_page'));
        if ($permissions->lastPage() >= request('page')) {
            return view('tenants.permissions.index', compact('permissions'));
        }
        return to_route('permissions.index', ['page' => request('page')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('tenants.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->validated());

        $users = User::whereHas("roles", function ($q) {
            $q->Where(function ($query) {
                // "Admin",
                $query->whereIn("name", ['SuperAdmin']);
            });
        })->get();

        foreach ($users as $user) {
            $user->givePermissionTo([$request->name]);
        }

        session()->flash('message', __('permission.message.save-message'));
        session()->flash('error', 'success');

        return to_route('permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('tenants.permissions.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('tenants.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $data = $request->validated();
        $permission->update($data);

        session()->flash('message', __('permission.message.update-message'));
        session()->flash('error', 'success');
        return view('tenants.permissions.edit', compact('permission'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->destroy($permission->id);
        session()->flash('message', __('permission.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('permissions.index', ['page' => request('page')]);
    }
    public function restoreUser($id)
    {

        $record = Permission::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('permission.message.restore-message'));
        session()->flash('error', 'success');

        return to_route('permissions.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = Permission::withTrashed()->find($id);
        $record->forceDelete();
        session()->flash('message', __('permission.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('permissions.index', ['page' => request('page')]);
    }
}