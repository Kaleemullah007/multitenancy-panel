<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $plans = Plan::withTrashed()->paginate(config('app.per_page'));
        if ($plans->lastPage() >= request('page')) {
            return view('tenants.plans.index', compact('plans'));
        }
        return to_route('plans.index', ['page' => request('page')]);
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
        session()->flash('message', __('plan.message.save-message'));
        session()->flash('error', 'success');
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
        return view('tenants.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $oldplan = $plan;
        $plan->update($request->validated());
        session()->flash('message', __('plan.message.update-message'));
        session()->flash('error', 'success');
        return to_route('plans.edit', [$oldplan->id]);
    }

    /**
     * Remove the specified as Softdelete.
     */
    public function destroy(Plan $plan)
    {

        if (Auth::user()->hasRole('ownerproduct')) {
            $plan->destroy($plan->id);
        } else {
            session()->flash('message', __('plan.message.error_auth_delete_message'));
            session()->flash('error', 'danger');
        }
        session()->flash('message', __('plan.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('plans.index', ['page' => request('page')]);
    }

    /**
     * Restore the specified from Softdelete.
     */

    public function restore($id)
    {

        $record = Plan::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('plan.message.restore-message'));
        session()->flash('error', 'success');
        return to_route('plans.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Permanently delete Record including database
     */

    public function deletePermanently($id)
    {
        $record = Plan::withTrashed()->find($id);
        $record->user()->update(['plan_id' => null]);
        $record->forceDelete();
        session()->flash('message', __('plan.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('plans.index', ['page' => request('page')]);
    }
}
