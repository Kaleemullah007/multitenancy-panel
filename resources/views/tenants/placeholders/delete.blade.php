
@if (is_null($placeholder->deleted_at))
    @haspermission('placeholders_delete')
    <form action="{{ route('placeholders.destroy', $placeholder->id) }}" method="post" class="d-inline" id="delete_from_{{$placeholder->id}}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">
        <a href="javascript:void(0);"  class="" data-bs-toggle="tooltip" data-bs-placement="top" 
            title="{{ __('placeholder.btn-delete') }}">
            <img
            src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data" data-id="{{$placeholder->id}}">
        </a>  
    </form>
    @endhaspermission
@else
    @haspermission('placeholders_force_delete')
        <form  id="pdelete_from_{{$placeholder->id}}" action="{{ route('placeholders.deleted', $placeholder->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

            <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('placeholder.btn_permanently_deleted') }}">
                <img
                src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p" data-id="{{$placeholder->id}}">
            </a>  
        </form>
    @endhaspermission
    @haspermission('placeholders_restore')
        <form id="rdelete_from_{{$placeholder->id}}" action="{{ route('placeholders.restored', $placeholder->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            

                <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('placeholder.btn_restored') }}">
                    <img
                    src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r" data-id="{{$placeholder->id}}">
                </a>  


        </form>
    @endhaspermission
@endif
