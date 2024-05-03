@if (is_null($tenant->deleted_at))
    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button> {{ __('tenant.btn-deleted') }}</button>
    </form>
@else
    <form action="{{ route('tenants.deleted', $tenant->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-lg btn-danger">{{ __('tenant.btn_permanently_deleted') }}</button>
    </form>

    <form action="{{ route('tenants.restored', $tenant->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-lg btn-info">{{ __('tenant.btn_restored') }}</button>
    </form>
@endif
