@extends('layouts.app')
@section('content')
    @haspermission('permissions_create')
        <a class="btn btn-lg bg-primary" href="{{ route('permissions.create') }}">Create</a>
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

            @foreach ($permissions as $key => $permission)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $permission->name }}</td>

                    <td>
                        @haspermission('permissions_edit')
                            <a href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                        @endhaspermission
                        @include('tenants.permissions.delete')

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
