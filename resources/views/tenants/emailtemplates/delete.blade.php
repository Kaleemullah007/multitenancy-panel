@if (is_null($emailtemplate->deleted_at))
    @haspermission('emailtemplates_delete')
        <form action="{{ route('emailtemplates.destroy', $emailtemplate->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button> {{ __('emailtemplate.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('emailtemplates_force_delete')
        <form action="{{ route('emailtemplates.deleted', $emailtemplate->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-danger"> {{ __('emailtemplate.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('emailtemplates_restore')
        <form action="{{ route('emailtemplates.restored', $emailtemplate->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-info"> {{ __('emailtemplate.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
