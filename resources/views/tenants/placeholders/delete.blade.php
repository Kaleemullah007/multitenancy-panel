@if (is_null($placeholder->deleted_at))
    @haspermission('placeholders_delete')
        <form action="{{ route('placeholders.destroy', $placeholder->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button> {{ __('placeholder.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('placeholders_force_delete')
        <form action="{{ route('placeholders.deleted', $placeholder->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-danger"> {{ __('placeholder.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('placeholders_restore')
        <form action="{{ route('placeholders.restored', $placeholder->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-info"> {{ __('placeholder.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
