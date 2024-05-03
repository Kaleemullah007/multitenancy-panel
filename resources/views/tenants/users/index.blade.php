@extends('layouts.app')
@section('content')
    @haspermission('user_create')
        <a class="btn btn-lg bg-primary" href="{{ route('users.create') }}">{{ __('tenantuser.create') }}</a>
    @endhaspermission
    <div>
        @if (session()->has('message'))
            <div class="alert text-center alert-{{ session('error') }}">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('tenantuser.table.#') }}</th>
                <th scope="col">{{ __('tenantuser.table.name') }}</th>
                <th scope="col">{{ __('tenantuser.table.email') }}</th>
                <th scope="col">{{ __('tenantuser.table.role') }}</th>
                <th scope="col">{{ __('tenantuser.table.action') }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($users as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge bg-danger">{{ $role->name }} {{ $loop->last ? '' : ',' }}</span>
                        @endforeach
                    </td>
                    <td>
                        @haspermission('manage_permissions')
                            <a
                                href="{{ route('users.manage-permissions', encrypt($user->id)) }}">{{ __('tenantuser.btn-manage-permission') }}</a>
                        @endhaspermission

                        @haspermission('user_edit')
                            <br>
                            <a href="{{ route('users.edit', $user->id) }}">{{ __('tenantuser.edit') }}</a>
                        @endhaspermission

                        @include('tenants.users.delete')

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($users->count() > 0)
        <div class="container">
            {{ $users->onEachSide(5)->links() }}
        </div>
    @endif
@endsection
