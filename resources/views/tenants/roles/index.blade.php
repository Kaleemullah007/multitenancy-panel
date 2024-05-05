@extends('layouts.app')
@section('content')
    @haspermission('roles_create')
        <a class="btn btn-lg bg-primary" href="{{ route('roles.create') }}">Create</a>
    @endhaspermission
    <table class="table">
        @if (session()->has('message'))
            <div class="alert text-center alert-{{ session('error') }}">
                {{ session('message') }}
            </div>
        @endif
        <thead>
            <tr>
                <th scope="col">{{ __('role.table.#') }}</th>
                <th scope="col">{{ __('role.table.name') }}</th>
                <th scope="col">{{ __('role.table.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                if (request('page') > 1) {
                    $counter = (request('page') - 1) * config('app.per_page') + 1;
                } else {
                    $counter = 1;
                }

            @endphp
            @if ($roles->count() > 0)
                @haspermission('roles_view')
                    @foreach ($roles as $key => $role)
                        <tr>
                            <th scope="row">{{ $counter++ }}</th>
                            <td>{{ $role->name }}</td>

                            <td>
                                @haspermission('roles_edit')
                                    <a
                                        href="{{ route('roles.edit', $role->id) }}?page={{ $roles->currentPage() }}">{{ __('role.edit') }}</a>
                                @endhaspermission
                                @include('tenants.roles.delete', ['record' => $role])

                            </td>
                        </tr>
                    @endforeach
                @endhaspermission
            @else
                <tr>
                    <td colspan="3" class="text-center">{{ __('general.no-record') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="container">
        {{ $roles->onEachSide(5)->links() }}
    </div>
@endsection
