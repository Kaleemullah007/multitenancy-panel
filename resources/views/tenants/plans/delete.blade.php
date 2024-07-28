
@if (is_null($plan->deleted_at))
    @haspermission('plan_delete')
    <form action="{{ route('plans.destroy', $plan->id) }}" method="post" class="d-inline" id="delete_from_{{$plan->id}}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="page" id="page" value="{{ request('page') }}">
        <a href="javascript:void(0);"  class="">
            <img
            src="assets/img/icons/delete.svg" alt="img" class="icon-adjustment _delete_data" data-id="{{$plan->id}}">
        </a>  
    </form>
    @endhaspermission
@else
    @haspermission('plan_force_delete')
        <form  id="pdelete_from_{{$plan->id}}" action="{{ route('plans.deleted', $plan->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

            <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('plan.btn_permanently_deleted') }}">
                <img
                src="assets/img/icons/delete-permanent.svg" alt="img" class="icon-adjustment _delete_p" data-id="{{$plan->id}}">
            </a>  
        </form>
    @endhaspermission
    @haspermission('plan_restore')
        <form id="rdelete_from_{{$plan->id}}" action="{{ route('plans.restored', $plan->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            

                <a href="javascript:void(0);"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('plan.btn_restored') }}">
                    <img
                    src="assets/img/icons/restore.svg" alt="img" class="icon-adjustment _delete_r" data-id="{{$plan->id}}">
                </a>  


        </form>
    @endhaspermission
@endif
