@if (is_null($compaign->deleted_at))
    @haspermission('compaigns_delete')
        <form action="{{ route('compaigns.destroy', $compaign->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button> {{ __('compaign.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('compaigns_force_delete')
        <form action="{{ route('compaigns.deleted', $compaign->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-danger"> {{ __('compaign.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('compaigns_restore')
        <form action="{{ route('compaigns.restored', $compaign->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-info"> {{ __('compaign.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
