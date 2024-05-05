@extends('layouts.app')
@section('content')
    @haspermission('permissions_create')
        <a class="btn btn-lg bg-primary" href="{{ route('permissions.create') }}">{{ __('permission.create') }}</a>
    @endhaspermission
    <table class="table">
        @if (session()->has('message'))
            <div class="alert text-center alert-{{ session('error') }}">
                {{ session('message') }}
            </div>
        @endif
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('permission.table.name') }}</th>
                <th scope="col">{{ __('permission.table.action') }}</th>
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
            @if ($permissions->count() > 0)
                @foreach ($permissions as $key => $permission)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $permission->name }}</td>

                        <td>
                            @haspermission('permissions_edit')
                                <a
                                    href="{{ route('permissions.edit', $permission->id) }}?page={{ $permissions->currentPage() }}">{{ __('permission.edit') }}</a>
                            @endhaspermission
                            @include('tenants.permissions.delete')

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">{{ __('general.no-record') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="container">
        {{ $permissions->onEachSide(5)->links() }}
    </div>
@endsection
