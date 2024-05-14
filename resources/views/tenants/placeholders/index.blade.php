@extends('layouts.app')
@section('content')
    @haspermission('placeholders_create')
        <a class="btn btn-lg bg-primary" href="{{ route('placeholders.create') }}">{{ __('placeholder.create') }}</a>
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
                <th scope="col">{{ __('placeholder.table.name') }}</th>
                <th scope="col">{{ __('placeholder.table.key_name') }}</th>
                <th scope="col">{{ __('placeholder.table.action') }}</th>
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
            @if ($placeholders->count() > 0)
                @foreach ($placeholders as $key => $placeholder)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $placeholder->name }}</td>
                        <td>{{ $placeholder->key_name }}</td>

                        <td>
                            @haspermission('placeholders_edit')
                                <a
                                    href="{{ route('placeholders.edit', $placeholder->id) }}?page={{ $placeholders->currentPage() }}">{{ __('placeholder.edit') }}</a>
                            @endhaspermission
                            @include('tenants.placeholders.delete')

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
        {{ $placeholders->onEachSide(5)->links() }}
    </div>
@endsection
