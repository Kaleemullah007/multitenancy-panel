
@if (is_null($permission->deleted_at))
    @haspermission('permissions_delete')
    <form action="{{ route('permissions.destroy', $permission->id) }}" method="post" class="d-inline" id="delete_from_{{$permission->id}}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">
        <a href="javascript:void(0);"  class="">
            <img
            src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data" data-id="{{$permission->id}}">
        </a>  
    </form>
    @endhaspermission
@else
    @haspermission('permissions_force_delete')
        <form  id="pdelete_from_{{$permission->id}}" action="{{ route('permissions.user-deleted', $permission->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

            <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('permission.btn_permanently_deleted') }}">
                <img
                src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p" data-id="{{$permission->id}}">
            </a>  
        </form>
    @endhaspermission
    @haspermission('permissions_restore')
        <form id="rdelete_from_{{$permission->id}}" action="{{ route('permissions.user-restored', $permission->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            

                <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('permission.btn_restored') }}">
                    <img
                    src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r" data-id="{{$permission->id}}">
                </a>  


        </form>
    @endhaspermission
@endif

