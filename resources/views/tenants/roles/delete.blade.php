@if (is_null($role->deleted_at))
    @haspermission('roles_delete')
        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button> Delete</button>
        </form>
    @endhaspermission
@else
    @haspermission('permissions_force_delete')
        <form action="{{ route('roles.user-deleted', $role->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-danger"> Permanently Deleted</button>
        </form>
    @endhaspermission
    @haspermission('permissions_restore')
        <form action="{{ route('roles.user-restored', $role->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-info"> Restore</button>
        </form>
    @endhaspermission
@endif
