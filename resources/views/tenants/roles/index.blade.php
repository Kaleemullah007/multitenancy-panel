@extends('layouts.app')
@section('content')
    @haspermission('roles_create')
        <a class="btn btn-lg bg-primary" href="{{ route('roles.create') }}">Create</a>
    @endhaspermission
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @haspermission('roles_view')
                @foreach ($roles as $key => $role)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $role->name }}</td>

                        <td>
                            @haspermission('roles_edit')
                                <a href="{{ route('roles.edit', $role->id) }}">Edit</a>
                            @endhaspermission
                            @include('tenants.roles.delete', ['record' => $role])

                        </td>
                    </tr>
                @endforeach
            @endhaspermission
        </tbody>
    </table>
@endsection
