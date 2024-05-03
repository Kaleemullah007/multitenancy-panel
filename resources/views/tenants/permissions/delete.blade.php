@if (is_null($permission->deleted_at))
    @haspermission('permissions_delete')
        <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button> {{ __('permission.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('permissions_force_delete')
        <form action="{{ route('permissions.user-deleted', $permission->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-danger"> {{ __('permission.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('permissions_restore')
        <form action="{{ route('permissions.user-restored', $permission->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-info"> {{ __('permission.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
