@extends('layouts.app')

@section('content')
    <a href="{{ route('tenants.create') }}">create Tenants</a>
    <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">Tenants</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Domains</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($tenants as $key => $tenant)
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
                    <td> @include('tenant.delete')</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
