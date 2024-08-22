@if (is_null($campaign->deleted_at))
    @haspermission('campaigns_delete')
        <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="post" class="d-inline"
            id="delete_from_{{ $campaign->id }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <a href="javascript:void(0);" class="">
                <img src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data"
                    data-id="{{ $campaign->id }}">
            </a>
        </form>
    @endhaspermission
@else
    @haspermission('campaigns_force_delete')
        <form id="pdelete_from_{{ $campaign->id }}" action="{{ route('campaigns.deleted', $campaign->id) }}" method="post"
            class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ __('campaign.btn_permanently_deleted') }}">
                <img src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p"
                    data-id="{{ $campaign->id }}">
            </a>
        </form>
    @endhaspermission
    @haspermission('campaigns_restore')
        <form id="rdelete_from_{{ $campaign->id }}" action="{{ route('campaigns.restored', $campaign->id) }}"
            method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">


            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ __('campaign.btn_restored') }}">
                <img src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r"
                    data-id="{{ $campaign->id }}">
            </a>


        </form>
    @endhaspermission
@endif
