<?php

namespace App\Http\Controllers\Tenants\Emailtemplate;

use App\Models\EmailTemplate;
use App\Http\Requests\StoreEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RevalidateBackHistory;
use App\Models\Placeholder;

class EmailTemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware(RevalidateBackHistory::class);

        $this->middleware('permission:emailtemplates_view', [
            'only' => 'index'
        ]);
        $this->middleware('permission:emailtemplates_edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:emailtemplates_delete', [
            'only' => ['destroy']
        ]);

        $this->middleware('permission:emailtemplates_restore', [
            'only' => ['restoreUser']
        ]);
        $this->middleware('permission:emailtemplates_force_delete', [
            'only' => ['deletePermanently']
        ]);
        $this->middleware('permission:emailtemplates_create', [
            'only' => ['create', 'store']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emailtemplates = EmailTemplate::withTrashed()->paginate(config('app.per_page'));
        if ($emailtemplates->lastPage() >= request('page')) {
            return view('tenants.emailtemplates.index', compact('emailtemplates'));
        }
        return to_route('emailtemplates.index', ['page' => request('page')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $placehoders = Placeholder::all();
        return view('tenants.emailtemplates.create', compact('placehoders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmailTemplateRequest $request)
    {
        EmailTemplate::create($request->validated());

        session()->flash('message', __('emailtemplate.message.save-message'));
        session()->flash('error', 'success');

        return to_route('emailtemplates.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailTemplate $emailTemplate)
    {
        return view('tenants.emailtemplates.show', compact('emailTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $emailtemplate)
    {
        $placehoders = Placeholder::all();
        return view('tenants.emailtemplates.edit', compact('emailtemplate', 'placehoders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailTemplateRequest $request, EmailTemplate $emailtemplate)
    {
        $data = $request->validated();
        $emailtemplate->update($data);

        session()->flash('message', __('emailtemplate.message.update-message'));
        session()->flash('error', 'success');
        return view('tenants.emailtemplates.edit', compact('emailtemplate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailtemplate)
    {
        $emailtemplate->destroy($emailtemplate->id);
        session()->flash('message', __('emailtemplate.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('emailtemplates.index', ['page' => request('page')]);
    }
    public function restored($id)
    {

        $record = EmailTemplate::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('emailtemplate.message.restore-message'));
        session()->flash('error', 'success');

        return to_route('emailtemplates.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = EmailTemplate::withTrashed()->find($id);
        $record->forceDelete();
        session()->flash('message', __('emailtemplate.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('emailtemplates.index', ['page' => request('page')]);
    }
}
