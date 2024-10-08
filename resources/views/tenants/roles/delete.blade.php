@if (is_null($role->deleted_at))
    @haspermission('roles_delete')
        <form action="{{ route('roles.destroy', $role->id) }}" method="post" class="d-inline"
            id="delete_from_{{ $role->id }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <a href="javascript:void(0);" class=""  data-bs-toggle="tooltip" data-bs-placement="top" 
            title="{{ __('role.btn-delete') }}">
                <img src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data"
                    data-id="{{ $role->id }}">
            </a>
        </form>
    @endhaspermission
@else
    @haspermission('roles_force_delete')
        <form id="pdelete_from_{{ $role->id }}" action="{{ route('roles.user-deleted', $role->id) }}" method="post"
            class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ __('role.btn_permanently_deleted') }}">
                <img src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p"
                    data-id="{{ $role->id }}">
            </a>
        </form>
    @endhaspermission
    @haspermission('roles_restore')
        <form id="rdelete_from_{{ $role->id }}" action="{{ route('roles.user-restored', $role->id) }}"
            method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">


            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ __('role.btn_restored') }}">
                <img src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r"
                    data-id="{{ $role->id }}">
            </a>


        </form>
    @endhaspermission
@endif

