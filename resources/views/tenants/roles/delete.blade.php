@if (is_null($role->deleted_at))
    @haspermission('roles_delete')
        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button> {{ __('role.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('roles_force_delete')
        <form action="{{ route('roles.user-deleted', $role->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-danger"> {{ __('role.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('roles_restore')
        <form action="{{ route('roles.user-restored', $role->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-info"> {{ __('role.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
