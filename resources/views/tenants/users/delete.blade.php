@if (is_null($user->deleted_at))
    @haspermission('user_delete')
        <form action="{{ route('users.destroy', $user->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button> {{ __('tenantuser.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('user_force_delete')
        <form action="{{ route('users.user-deleted', $user->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-danger">{{ __('tenantuser.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('user_restore')
        <form action="{{ route('users.user-restored', $user->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-lg btn-info"> {{ __('tenantuser.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
