
@if (is_null($tenant->deleted_at))
    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="post" class="d-inline" id="delete_from_{{$tenant->id}}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">
        <a href="javascript:void(0);"  class="">
            <img
            src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data" data-id="{{$tenant->id}}">
        </a>  

    </form>
@else
    <form  id="pdelete_from_{{$tenant->id}}" action="{{ route('tenants.deleted', $tenant->id) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">

        <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.btn_permanently_deleted') }}">
            <img
            src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p" data-id="{{$tenant->id}}">
        </a>  
    </form>

    <form id="rdelete_from_{{$tenant->id}}" action="{{ route('tenants.restored', $tenant->id) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">
        

            <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.btn_restored') }}">
                <img
                src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r" data-id="{{$tenant->id}}">
            </a>  


    </form>
@endif


