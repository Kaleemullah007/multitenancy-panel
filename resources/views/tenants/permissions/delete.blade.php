@if (is_null($permission->deleted_at))
    @haspermission('permissions_delete')
        <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button> Delete</button>
        </form>
    @endhaspermission
@else
    @haspermission('permissions_force_delete')
        <form action="{{ route('permissions.user-deleted', $permission->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-danger"> Permanently Deleted</button>
        </form>
    @endhaspermission
    @haspermission('permissions_restore')
        <form action="{{ route('permissions.user-restored', $permission->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-info"> Restore</button>
        </form>
    @endhaspermission
@endif
