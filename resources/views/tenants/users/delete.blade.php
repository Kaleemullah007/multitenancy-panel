@if (is_null($user->deleted_at))
    @haspermission('user_delete')
        <form action="{{ route('users.destroy', $user->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button> Delete</button>
        </form>
    @endhaspermission
@else
    @haspermission('user_force_delete')
        <form action="{{ route('users.user-deleted', $user->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-danger"> Permanently Deleted</button>
        </form>
    @endhaspermission
    @haspermission('user_restore')
        <form action="{{ route('users.user-restored', $user->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-info"> Restore</button>
        </form>
    @endhaspermission
@endif
