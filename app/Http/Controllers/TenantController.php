<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Database\Models\Domain;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tenants = Tenant::withTrashed()->with(['domains'])->paginate($this->per_page);
        return view('tenant.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = Plan::ActivePlans()->get();

        return view('tenant.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantRequest $request)
    {
        $data = $request->validated();
        // dd($data);

        // $filename = $request->photo->getClientOriginalName();
        // $request->photo->storeAs('photos', $filename);
        // $file = request()->file('photos');
        // $path = $request->photo->storeAs('avatars');

        $path = Storage::disk('public')->putFile('photos', $request->file('photo'));

        $user  = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'validaty' => $data['validaty'],
            'plan_name' => $data['plan_name'],
            'plan_price' => $data['plan_price'],


        ]);
        // dd($user_id);
        $tenant = Tenant::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => true,
            'file' => $path,
            'user_id' => $user->id
        ]);
        // dd($path);
        $tenant->domains()->create([
            'domain' => $data['domain_name'] . '.' . config('app.domain')
        ]);

        return to_route('tenants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('tenant.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $tenant->load('domains');
        $plans = Plan::ActivePlans()->get();
        return view('tenant.edit', compact('tenant', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {

        $data = $request->validated();
        if (is_null($request->password)) {
            unset($data['password']);
        }

        if ($request->has('photo')) {
            $path = Storage::disk('public')->putFile('photos', $request->file('photo'));
            $data['file'] = $path;
        }
        $tenant->update($data);
        $tenant->user()->update(['name' => $data['name'], 'email' => $data['email'], 'status' => $data['status']]);
        return to_route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, $tenant)
    {

        // if ($user->hasRole('Admin')) {

        //     session()->flash('message', 'You can not delete admin.');
        //     session()->flash('error', 'danger');

        //     // $user->save();

        // } else {

        $tenant = Tenant::withTrashed()->find($tenant);
        // dd($tenant);
        // $tenant->destroy($tenant->id);
        $tenant->deleted_at  = now();
        $tenant->save();
        // }
        return to_route('tenants.index');
    }

    public function restore($id)
    {


        $record = Tenant::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post

        return to_route('tenants.index');
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {

        $record = Tenant::withTrashed()->find($id);

        // Domain::where('tenant_id', $record->id)->delete();
        $record->domains()->delete();

        User::whereEmail($record->email)->forceDelete();

        $record->forceDelete();

        return to_route('tenants.index');
    }
}