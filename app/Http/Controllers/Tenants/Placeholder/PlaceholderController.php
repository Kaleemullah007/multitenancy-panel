<?php

namespace App\Http\Controllers\Tenants\Placeholder;

use App\Models\Placeholder;
use App\Http\Requests\StorePlaceholderRequest;
use App\Http\Requests\UpdatePlaceholderRequest;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RevalidateBackHistory;

class PlaceholderController extends Controller
{

    public function __construct()
    {
        $this->middleware(RevalidateBackHistory::class);

        $this->middleware('permission:placeholders_view', [
            'only' => 'index'
        ]);
        $this->middleware('permission:placeholders_edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:placeholders_delete', [
            'only' => ['destroy']
        ]);

        $this->middleware('permission:placeholders_restore', [
            'only' => ['restored']
        ]);
        $this->middleware('permission:placeholders_force_delete', [
            'only' => ['deletePermanently']
        ]);
        $this->middleware('permission:placeholders_create', [
            'only' => ['create', 'store']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $placeholders = Placeholder::withTrashed()->paginate(config('app.per_page'));
        if ($placeholders->lastPage() >= request('page')) {
            return view('tenants.placeholders.index', compact('placeholders'));
        }
        return to_route('placeholders.index', ['page' => request('page')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.placeholders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlaceholderRequest $request)
    {
        Placeholder::create($request->validated());

        session()->flash('message', __('placeholder.message.save-message'));
        session()->flash('error', 'success');

        return to_route('placeholders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Placeholder $placeholder)
    {
        return view('tenants.placeholders.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Placeholder $placeholder)
    {
        return view('tenants.placeholders.edit', compact('placeholder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlaceholderRequest $request, Placeholder $placeholder)
    {
        $data = $request->validated();
        $placeholder->update($data);

        session()->flash('message', __('placeholder.message.update-message'));
        session()->flash('error', 'success');
        return view('tenants.placeholders.edit', compact('placeholder'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Placeholder $placeholder)
    {
        $placeholder->destroy($placeholder->id);
        session()->flash('message', __('placeholder.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('placeholders.index', ['page' => request('page')]);
    }
    public function restored($id)
    {

        $record = Placeholder::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('placeholder.message.restore-message'));
        session()->flash('error', 'success');

        return to_route('placeholders.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = Placeholder::withTrashed()->find($id);
        $record->forceDelete();
        session()->flash('message', __('placeholder.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('placeholders.index', ['page' => request('page')]);
    }
}