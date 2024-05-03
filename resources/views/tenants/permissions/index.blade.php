@extends('layouts.app')
@section('content')
    @haspermission('permissions_create')
        <a class="btn btn-lg bg-primary" href="{{ route('permissions.create') }}">{{ __('permission.create') }}</a>
    @endhaspermission
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('permission.table.name') }}</th>
                <th scope="col">{{ __('permission.table.action') }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($permissions as $key => $permission)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $permission->name }}</td>

                    <td>
                        @haspermission('permissions_edit')
                            <a href="{{ route('permissions.edit', $permission->id) }}">{{ __('permission.edit') }}</a>
                        @endhaspermission
                        @include('tenants.permissions.delete')

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
        {{ $permissions->onEachSide(5)->links() }}
    </div>
@endsection
