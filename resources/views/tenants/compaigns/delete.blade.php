@if (is_null($campaign->deleted_at))
    @haspermission('campaigns_delete')
        <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button> {{ __('compaign.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('campaigns_force_delete')
        <form action="{{ route('campaigns.deleted', $campaign->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-danger"> {{ __('compaign.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('campaigns_restore')
        <form action="{{ route('campaigns.restored', $campaign->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-info"> {{ __('compaign.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
