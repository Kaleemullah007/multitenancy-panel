
@if (is_null($user->deleted_at))
    @haspermission('user_delete')
    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline" id="delete_from_{{$user->id}}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">
        <a href="javascript:void(0);"  class="" data-bs-toggle="tooltip" data-bs-placement="top" 
            title="{{ __('tenantuser.btn-delete') }}">
            <img
            src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data" data-id="{{$user->id}}">
        </a>  
    </form>
    @endhaspermission
@else
    @haspermission('user_force_delete')
        <form  id="pdelete_from_{{$user->id}}" action="{{ route('users.user-deleted', $user->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

            <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenantuser.btn_permanently_deleted') }}">
                <img
                src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p" data-id="{{$user->id}}">
            </a>  
        </form>
    @endhaspermission
    @haspermission('user_restore')
        <form id="rdelete_from_{{$user->id}}" action="{{ route('users.user-restored', $user->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            

                <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenantuser.btn_restored') }}">
                    <img
                    src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r" data-id="{{$user->id}}">
                </a>  


        </form>
    @endhaspermission
@endif

