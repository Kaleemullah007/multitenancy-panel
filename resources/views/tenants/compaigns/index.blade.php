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
            @if ($campaigns->count() > 0)
                @foreach ($campaigns as $key => $campaign)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $campaign->name }}</td>
                        <td>{{ $campaign->user_type }}</td>
                        <td>{{ $campaign->email_template_id }}</td>
                        <td>{{ $campaign->published_at }}</td>
                        <td>{{ $campaign->type->getlabelText() }}</td>
                        <td>{{ $campaign->status }}</td>

                        <td>
                            @haspermission('campaigns_edit')
                                <a
                                    href="{{ route('campaigns.edit', $campaign->id) }}?page={{ $campaigns->currentPage() }}">{{ __('compaign.edit') }}</a>
                            @endhaspermission
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
        {{ $campaigns->onEachSide(5)->links() }}
    </div>
@endsection
