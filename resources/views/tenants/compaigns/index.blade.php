@extends('layouts.app')
@section('content')
    @haspermission('compaigns_create')
        <a class="btn btn-lg bg-primary" href="{{ route('compaigns.create') }}">{{ __('compaign.create') }}</a>
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
                <th scope="col">{{ __('compaign.table.name') }}</th>
                <th scope="col">{{ __('compaign.table.user_type') }}</th>
                <th scope="col">{{ __('compaign.table.template_type') }}</th>
                <th scope="col">{{ __('compaign.table.published_at') }}</th>
                <th scope="col">{{ __('compaign.table.type') }}</th>
                <th scope="col">{{ __('compaign.table.status') }}</th>
                <th scope="col">{{ __('compaign.table.action') }}</th>
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
            @if ($compaigns->count() > 0)
                @foreach ($compaigns as $key => $compaign)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $compaign->name }}</td>
                        <td>{{ $compaign->user_type }}</td>
                        <td>{{ $compaign->email_template_id }}</td>
                        <td>{{ $compaign->published_at }}</td>
                        <td>{{ $compaign->type->getlabelText() }}</td>
                        <td>{{ $compaign->status }}</td>

                        <td>
                            {{-- @haspermission('compaigns_edit') --}}
                            <a
                                href="{{ route('compaigns.edit', $compaign->id) }}?page={{ $compaigns->currentPage() }}">{{ __('compaign.edit') }}</a>
                            {{-- @endhaspermission --}}
                            @include('tenants.compaigns.delete')

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
        {{ $compaigns->onEachSide(5)->links() }}
    </div>
@endsection
