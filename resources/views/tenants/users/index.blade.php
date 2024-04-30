@extends('layouts.app')
@section('content')
    @haspermission('user_create')
        <a class="btn btn-lg bg-primary" href="{{ route('users.create') }}">Create</a>
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
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">action</th>
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
                            <a href="{{ route('users.manage-permissions', encrypt($user->id)) }}">Manage permission</a>
                        @endhaspermission

                        @haspermission('user_edit')
                            <br>
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        @endhaspermission

                        @include('tenants.users.delete')

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
