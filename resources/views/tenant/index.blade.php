@extends('layouts.app')

@section('content')
    @haspermission('tenant_create')
        <a href="{{ route('tenants.create') }}">{{ __('tenant.create_user') }}</a>
    @endhaspermission
    @haspermission('tenant_view')
        <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">{{ __('tenant.users') }}</a>
    @endhaspermission
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('tenant.table.#') }}</th>
                <th scope="col">{{ __('tenant.table.name') }}</th>
                <th scope="col">{{ __('tenant.table.email') }}</th>
                <th scope="col">{{ __('tenant.table.domains') }}</th>
                <th scope="col">{{ __('tenant.table.action') }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($tenants as $key => $tenant)
                {{-- @dd($tenant) --}}
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $tenant->name }}</td>
                    <td>{{ $tenant->email }}</td>
                    <td>
                        @foreach ($tenant->domains as $domain)
                            <span class="badge bg-danger"><button class="mybutton" id="{{ $domain->id }}href"
                                    rel="{{ $domain->domain }}{{ $loop->last ? '' : ',' }}">{{ $domain->domain }}
                                    {{ $loop->last ? '' : ',' }}</button></span>
                        @endforeach

                    </td>
                    <td> <a href="{{ route('tenants.edit', $tenant->id) }}">{{ __('tenant.edit') }}</a>
                        @include('tenant.delete')</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="container">
        {{ $tenants->onEachSide(5)->links() }}
    </div>
@endsection
