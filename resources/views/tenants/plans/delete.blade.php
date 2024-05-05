@if (is_null($plan->deleted_at))
    @haspermission('plan_delete')
        <form action="{{ route('plans.destroy', $plan->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button> {{ __('plan.btn-deleted') }}</button>
        </form>
    @endhaspermission
@else
    @haspermission('plan_force_delete')
        <form action="{{ route('plans.deleted', $plan->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-danger"> {{ __('plan.btn_permanently_deleted') }}</button>
        </form>
    @endhaspermission
    @haspermission('plan_restore')
        <form action="{{ route('plans.restored', $plan->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" id="page" value="{{ request('page') }}">
            <button class="btn btn-lg btn-info"> {{ __('plan.btn_restored') }}</button>
        </form>
    @endhaspermission
@endif
