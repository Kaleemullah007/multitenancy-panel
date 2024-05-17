<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RevalidateBackHistory;
use App\Models\Campaign;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Jobs\EmailOrSmsJob;
use App\Models\EmailTemplate;
use App\Models\Placeholder;
use App\Models\ScheduleMessageHistory;
use App\Models\User;
use App\Services\Compaign\changeTemplateContent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CampaignController extends Controller
{

    protected $service_template;
    public function __construct(changeTemplateContent $service_template)
    {
        $this->middleware(RevalidateBackHistory::class);

        $this->middleware('permission:campaigns_view', [
            'only' => 'index'
        ]);
        $this->middleware('permission:campaigns_edit', [
            'only' => ['edit', 'update']
        ]);

        $this->middleware('permission:campaigns_delete', [
            'only' => ['destroy']
        ]);

        $this->middleware('permission:campaigns_restore', [
            'only' => ['restoreUser']
        ]);
        $this->middleware('permission:campaigns_force_delete', [
            'only' => ['deletePermanently']
        ]);
        $this->middleware('permission:campaigns_create', [
            'only' => ['create', 'store']
        ]);
        $this->service_template = $service_template;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::withTrashed()->paginate(config('app.per_page'));
        if ($campaigns->lastPage() >= request('page')) {
            return view('tenants.compaigns.index', compact('campaigns'));
        }
        return to_route('campaigns.index', ['page' => request('page')]);
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
    public function store(StoreCampaignRequest $request)
    {
        $data = $request->validated();

        $campaign  = Campaign::create($data);



        if ($campaign->status == 0) {
            $status_mesage = __('compaign.message.error_schedule_message');
        } else {

            $template = $campaign->emailTemplate;
            $this->service_template->prepareData($template, $data, $campaign);
            $status_mesage = __('compaign.message.success_schedule_message');
        }




        session()->flash('message', __('compaign.message.save-message') . $status_mesage);
        session()->flash('error', 'success');
        return to_route('campaigns.index', ['page' => request('page')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        return view('tenants.compaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {


        $startTime = Carbon::parse($campaign->created_at);
        $finishTime = Carbon::parse(now()->format('Y-m-d H:i:s'));


        $totalDuration = (int)$startTime->diffInMinutes($finishTime);
        // dd($startTime->format('Y-m-d H:i:s'), $finishTime->format('Y-m-d H:i:s'), $totalDuration);
        if ($totalDuration > 60) {
            session()->flash('message', __('compaign.message.no-edit'));
            session()->flash('error', 'warning');
            return to_route('campaigns.index', ['page' => request('page')]);
        }



        //
        // dd(Role::all()->pluck('name'));
        // $jobs_id = ScheduleMessageHistory::where(['campaign_id' => $campaign->id, 'sent' => 'N'])->get()->pluck('job_id', 'id');
        // dd($jobs_id->keys());
        // $jobs =  DB::connection('mysql')->table('jobs')->get([]);
        // $jobs =  app('queue')->getDatabase()->table('jobs')->where('id', 19)->first();;
        // dd($jobs);
        $roles  = Role::whereNot('name', 'SuperAdmin')->get();
        $emails = EmailTemplate::active()->get();
        return view('tenants.compaigns.edit', compact('campaign', 'emails', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $data = $request->validated();

        $jobs_id = ScheduleMessageHistory::where(['campaign_id' => $campaign->id, 'sent' => 'N'])->get()->pluck('job_id', 'id');

        if ($jobs_id->count() > 0) {
            DB::connection('mysql')->table('jobs')->whereIn('id', $jobs_id->values())->delete();
            ScheduleMessageHistory::whereIn('id', $jobs_id->keys())->delete();
        }

        $campaignObject  = $campaign;

        $campaign->update($data);


        if ($campaignObject->status == 0) {
            $status_mesage = __('compaign.message.error_schedule_message');
        } else {

            $template = $campaign->emailTemplate;
            $this->service_template->prepareData($template, $data, $campaignObject);

            $status_mesage = __('compaign.message.success_schedule_message');
        }

        session()->flash('message', __('compaign.message.save-message') . $status_mesage);
        session()->flash('error', 'success');
        return to_route('campaigns.edit',   $campaignObject->id);
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->destroy($campaign->id);
        session()->flash('message', __('compaign.message.delete-message'));
        session()->flash('error', 'danger');
        return to_route('campaigns.index', ['page' => request('page')]);
    }

    public function restored($id)
    {

        $record = Campaign::withTrashed()->find($id);
        $record->restore(); // This restores the soft-deleted post
        session()->flash('message', __('compaign.message.restore-message'));
        session()->flash('error', 'success');

        return to_route('campaigns.index', ['page' => request('page')]);
        // Additional logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePermanently($id)
    {
        $record = Campaign::withTrashed()->find($id);
        $record->forceDelete();
        session()->flash('message', __('compaign.message.permanently-delete-message'));
        session()->flash('error', 'danger');
        return to_route('campaigns.index', ['page' => request('page')]);
    }
}
