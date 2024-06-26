<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Requests\Permission\ManagePermissionsRequest;
use App\Http\Requests\Tenants\TenantUserRequest;
use App\Http\Requests\Tenants\UpdateTenantUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TenantUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {
        $this->middleware(RevalidateBackHistory::class);
        $this->middleware('permission:user_view', [
            'only' => 'index'
        ]);
        $this->middleware('permission:user_edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:user_delete', [
            'only' => ['destroy']
        ]);

        $this->middleware('permission:user_restore', [
            'only' => ['restoreUser']
        ]);
        $this->middleware('permission:user_force_delete', [
            'only' => ['deletePermanently']
        ]);
        $this->middleware('permission:user_create', [
            'only' => ['create', 'store']
        ]);
    }

    public function index()
    {




        $users = User::with('roles')
            ->superAdmin()
            ->withTrashed()
            ->paginate(config('app.per_page'));

        // dd($users);
        if ($users->lastPage() >= request('page')) {
            return view('tenants.users.index', compact('users'));
        }
        return to_route('tenants.index', ['page' => request('page')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // app('auth')->user()->can('permissions.user_create');

        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        return view('tenants.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantUserRequest $request)
    {


        $roles = $request->roles;
        $data = $request->validated();
        unset($data['roles']);
        $user = User::create($data);
        $user->assignRole($roles);


        session()->flash('message', __('tenantuser.message.save-message'));
        session()->flash('error', 'success');

        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //$user = User::with(['roles', 'permissions'])->find(decrypt($id));
        $user->load('roles');
        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        return view('tenants.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantUserRequest $request, User $user)
    {
        $data = $request->validated();
        if (is_null($request->password)) {
            unset($data['password']);
        }

        $roles = $request->roles;
        unset($data['roles']);
        $user->update($data);
        $user->assignRole($roles);

        session()->flash('message', __('tenantuser.message.update-message'));
        session()->flash('error', 'success');

        return to_route('users.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {


        if ($user->hasRole('SuperAdmin')) {

            session()->flash('message', __('tenantuser.message.delete-message'));
            session()->flash('error', 'danger');
        } else {
            $user->destroy($user->id);
        }
        return to_route('users.index', ['page' => request('page')]);
    }

    public function restoreUser($id)
    {


        $record = User::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('tenantuser.message.restore-message'));
        session()->flash('error', 'success');
        return to_route('users.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = User::withTrashed()->find($id);
        $record->forceDelete();
        session()->flash('message', __('tenantuser.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('users.index', ['page' => request('page')]);
    }



    //  Manage permission

    public function mangePermissions($id)
    {

        $user = User::with(['roles', 'permissions'])->find(decrypt($id));
        $roles = Role::get();
        $permissions = Permission::get();

        return view('tenants.users.manage-permissions', compact('user', 'roles', 'permissions'));
    }

    public function savePermissions(ManagePermissionsRequest $request, $id)
    {

        // dd($request->validated(), $id);
        $user = User::find(decrypt($id));
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        session()->flash('message', __('tenantuser.message.save-permission-message'));
        session()->flash('error', 'success');

        return redirect()->route('users.manage-permissions', $id);
    }
}
