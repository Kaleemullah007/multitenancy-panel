<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware(RevalidateBackHistory::class);
        $this->middleware('permission:plan_view', [
            'only' => 'index'
        ]);
        $this->middleware('permission:plan_edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:plan_delete', [
            'only' => ['destroy']
        ]);

        $this->middleware('permission:plan_restore', [
            'only' => ['restore']
        ]);
        $this->middleware('permission:plan_force_delete', [
            'only' => ['deletePermanently']
        ]);
        $this->middleware('permission:plan_create', [
            'only' => ['create', 'store']
        ]);
    }

    public function index()
    {

        $plans = Plan::paginate($this->per_page);
        // dd($plans);
        return view('tenants.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // app('auth')->user()->can('permissions.user_create');


        return view('tenants.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {





        Plan::create($request->validated());

        return to_route('plans.index');
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
    public function edit(Plan $plan)
    {
        //$user = Plan::with(['roles', 'permissions'])->find(decrypt($id));


        return view('tenants.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {

        // dd($request->validated());
        $plan->update($request->validated());

        return view('tenants.plans.edit', compact('plan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {


        if ($plan->hasRole('ownerproduct')) {
            $plan->destroy($plan->id);
        } else {
            session()->flash('message', __('plan.message.error_auth_delete_message'));
            session()->flash('error', 'danger');
        }
        return to_route('plans.index');
    }

    public function restore($id)
    {


        $record = Plan::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post

        return to_route('plans.index');
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = Plan::withTrashed()->find($id);
        $record->forceDelete();
        return to_route('plans.index');
    }
}