<?php

namespace App\Http\Controllers;

use App\Models\Compaign;
use App\Http\Requests\StoreCompaignRequest;
use App\Http\Requests\UpdateCompaignRequest;
use App\Jobs\EmailOrSmsJob;
use App\Models\EmailTemplate;
use App\Models\Placeholder;
use App\Models\User;
use App\Services\Compaign\changeTemplateContent;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class CompaignController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(RevalidateBackHistory::class);

    //     $this->middleware('permission:emailtemplates_view', [
    //         'only' => 'index'
    //     ]);
    //     $this->middleware('permission:emailtemplates_edit', [
    //         'only' => ['edit', 'update']
    //     ]);

    //     $this->middleware('permission:emailtemplates_delete', [
    //         'only' => ['destroy']
    //     ]);

    //     $this->middleware('permission:emailtemplates_restore', [
    //         'only' => ['restoreUser']
    //     ]);
    //     $this->middleware('permission:emailtemplates_force_delete', [
    //         'only' => ['deletePermanently']
    //     ]);
    //     $this->middleware('permission:emailtemplates_create', [
    //         'only' => ['create', 'store']
    //     ]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compaigns = Compaign::withTrashed()->paginate(config('app.per_page'));
        if ($compaigns->lastPage() >= request('page')) {
            return view('tenants.compaigns.index', compact('compaigns'));
        }
        return to_route('emailtemplates.index', ['page' => request('page')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles  = Role::whereNot('name', 'SuperAdmin')->get();
        $emails = EmailTemplate::active()->get();
        return view('tenants.compaigns.create', compact('emails', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompaignRequest $request)
    {
        $data = $request->validated();
        $compaign  = Compaign::insert($data);
        $email = new changeTemplateContent();
        $template = $compaign->emailTemplate;
        $email->prepareData($template, $data);

        session()->flash('message', __('compaign.message.save-message'));
        session()->flash('error', 'success');
        return to_route('compaigns.index', ['page' => request('page')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Compaign $compaign)
    {
        return view('tenants.compaigns.show', compact('compaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compaign $compaign)
    {
        //
        // dd(Role::all()->pluck('name'));
        $roles  = Role::whereNot('name', 'SuperAdmin')->get();
        $emails = EmailTemplate::active()->get();
        return view('tenants.compaigns.edit', compact('compaign', 'emails', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompaignRequest $request, Compaign $compaign)
    {
        $data = $request->validated();
        // dd($data);




        $compaign->update($data);

        $email = new changeTemplateContent();
        $template = $compaign->emailTemplate;
        $email->prepareData($template, $data);


        // dispatch(new EmailOrSmsJob($data, $users))->delay(Carbon::now()->addSeconds(10));;

        session()->flash('message', __('compaign.message.update-message'));
        session()->flash('error', 'success');
        return to_route('compaigns.edit',   $compaign->id);
        // view('tenants.compaigns.edit', compact('compaign'));
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compaign $compaign)
    {
        $compaign->destroy($compaign->id);
        session()->flash('message', __('compaign.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('compaigns.index', ['page' => request('page')]);
    }

    public function restored($id)
    {

        $record = Compaign::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('compaign.message.restore-message'));
        session()->flash('error', 'success');

        return to_route('compaigns.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = Compaign::withTrashed()->find($id);
        $record->forceDelete();
        session()->flash('message', __('compaign.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('compaigns.index', ['page' => request('page')]);
    }
}
