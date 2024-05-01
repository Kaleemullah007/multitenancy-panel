@if (is_null($tenant->deleted_at))
    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button> Delete</button>
    </form>
@else
    <form action="{{ route('tenants.deleted', $tenant->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-lg btn-danger"> Permanently Deleted</button>
    </form>

    <form action="{{ route('tenants.restored', $tenant->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-lg btn-info"> Restore</button>
    </form>
@endif
