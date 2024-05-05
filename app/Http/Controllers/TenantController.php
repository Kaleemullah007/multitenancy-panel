<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use App\Services\PlanHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Database\Models\Domain;

class TenantController extends Controller
{
    protected $plan_history;
    function __construct(PlanHistory $plan_history)
    {
        $this->plan_history = $plan_history;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        dd(date('d'));
        $tenants = Tenant::withTrashed()->with(['domains', 'user'])->paginate(config('app.per_page'));

        if ($tenants->lastPage() >= request('page')) {
            return view('tenant.index', compact('tenants'));
        }
        return to_route('tenants.index', ['page' => $tenants->lastPage()]);
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





        $user  = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'validaty' => $data['validaty'],
            'plan_name' => $data['plan_name'],
            'plan_id' => $data['plan_id'],
            'plan_price' => $data['plan_price'],


        ]);
        // dd($user_id);



        $data['user_id'] = $user->id;

        $this->plan_history->create($data);

        $tenant_data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => true,
            'user_id' => $user->id
        ];
        if ($request->has('photo')) {
            $path = Storage::disk('public')->putFile('photos', $request->file('photo'));
            $tenant_data['file'] = $path;
        }
        $tenant = Tenant::create($tenant_data);
        // dd($path);
        $tenant->domains()->create([
            'domain' => $data['domain_name'] . '.' . config('app.domain')
        ]);


        session()->flash('message', __('tenant.message.save-message'));
        session()->flash('error', 'success');
        return to_route('tenants.index');
    }


    function renew(Tenant $tenant)
    {




        $user = $tenant->user;
        $end_date = $tenant->user->end_date;
        $plan = Plan::where('id', $tenant->user->plan_id)->first();

        if (is_null($plan)) {
            session()->flash('message', 'No Plan found for this user');
            session()->flash('error', 'danger');
            return to_route('tenants.index');
        }


        $start_date = date('Y-m-d');
        $end_date = Carbon::parse($end_date)->addMonths($plan->validity_month)->format('Y-m-d');

        // dd($end_date);


        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['validaty'] = $plan->validity_month;
        $data['plan_name'] = $plan->name;
        $data['plan_price'] = $plan->price;
        $data['user_id'] = $user->id;
        $data['plan_id'] = $plan->id;


        $tenant->update(['status' => 1]);
        $tenant->user()->update([
            'status' => 1,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'validaty' => $data['validaty'],
            'plan_name' => $data['plan_name'],
            'plan_price' => $data['plan_price']
        ]);

        $this->plan_history->create($data);
        session()->flash('message', __('tenant.message.renew-message'));
        session()->flash('error', 'success');
        return to_route('tenants.index', ['page' => request('page')]);
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
        // dd($data);

        if (is_null($request->password)) {
            unset($data['password']);
        }

        if ($request->has('photo')) {
            $path = Storage::disk('public')->putFile('photos', $request->file('photo'));
            $data['file'] = $path;
        }

        $tenant->update($data);
        $tenant->user()->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'validaty' => $data['validaty'],
            'plan_name' => $data['plan_name'],
            'plan_id' => $data['plan_id'],
            'plan_price' => $data['plan_price'],
        ]);

        $update_plan = request('update_plan');
        if ($update_plan == 'on') {
            $user = $tenant->user;

            $data['user_id'] = $user->id;

            $this->plan_history->create($data);
        }

        session()->flash('message', __('tenant.message.update-message'));
        session()->flash('error', 'success');

        $tenant->domains()->update(['domain' => $data['name'] . '.' . config('app.domain')]);
        return to_route('tenants.index', ['page' => request('page')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tenant)
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
        session()->flash('message', __('tenant.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('tenants.index', ['page' => request('page')]);
    }

    public function restore($id)
    {


        $record = Tenant::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('tenant.message.restore-message'));
        session()->flash('error', 'success');
        return to_route('tenants.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {

        $record = Tenant::withTrashed()->find($id);

        if (is_null($record)) {
            session()->flash('message', __('general.unable-to-delete'));
            session()->flash('error', 'danger');
            return to_route('tenants.index', ['page' => request('page')]);
        }

        // Domain::where('tenant_id', $record->id)->delete();
        $record->domains()->delete();
        // $record->planHistory()->delete();

        $user  = User::withTrashed()->where('id', $record->user_id)->first();
        // dd($user);
        if (!is_null($user))
            $user->forceDelete();

        $record->forceDelete();
        session()->flash('message', __('tenant.message.permanently-delete-message'));
        session()->flash('error', 'danger');

        return to_route('tenants.index', ['page' => request('page')]);
    }
}