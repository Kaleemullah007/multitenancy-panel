
@if (is_null($emailtemplate->deleted_at))
    @haspermission('emailtemplates_delete')
    <form action="{{ route('emailtemplates.destroy', $emailtemplate->id) }}" method="post" class="d-inline" id="delete_from_{{$emailtemplate->id}}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">
        <a href="javascript:void(0);"  class="" data-bs-toggle="tooltip" data-bs-placement="top" 
            title="{{ __('emailtemplate.btn-delete') }}">
            <img
            src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data" data-id="{{$emailtemplate->id}}">
        </a>  
    </form>
    @endhaspermission
@else
    @haspermission('emailtemplates_force_delete')
        <form  id="pdelete_from_{{$emailtemplate->id}}" action="{{ route('emailtemplates.deleted', $emailtemplate->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

            <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('emailtemplate.btn_permanently_deleted') }}">
                <img
                src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p" data-id="{{$emailtemplate->id}}">
            </a>  
        </form>
    @endhaspermission
    @haspermission('emailtemplates_restore')
        <form id="rdelete_from_{{$emailtemplate->id}}" action="{{ route('emailtemplates.restored', $emailtemplate->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            

                <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('emailtemplate.btn_restored') }}">
                    <img
                    src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r" data-id="{{$emailtemplate->id}}">
                </a>  


        </form>
    @endhaspermission
@endif
