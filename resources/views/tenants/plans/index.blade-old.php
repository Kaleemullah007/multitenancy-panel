@extends('layouts.app')
@section('content')
    @haspermission('plan_create')
        <a class="btn btn-lg bg-primary" href="{{ route('plans.create') }}">{{ __('plan.create') }}</a>
    @endhaspermission
    <table class="table">
        @if (session()->has('message'))
            <div class="alert text-center alert-{{ session('error') }}">
                {{ session('message') }}
            </div>
        @endif
        <thead>
            <tr>
                <th scope="col">{{ __('plan.table.#') }}</th>
                <th scope="col">{{ __('plan.table.name') }}</th>
                <th scope="col">{{ __('plan.table.description') }}</th>
                <th scope="col">{{ __('plan.table.validity_month') }}</th>
                <th scope="col">{{ __('plan.table.price') }}</th>
                <th scope="col">{{ __('plan.table.btn') }}</th>
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
            @if ($plans->count() > 0)
                @haspermission('plan_view')
                    @foreach ($plans as $key => $plan)
                        <tr>
                            <th scope="row">{{ $counter++ }}</th>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->description }}</td>
                            <td>{{ $plan->validity_month }}</td>
                            <td>{{ $plan->price }}</td>
                            <td>
                                @haspermission('plan_edit')
                                    <a
                                        href="{{ route('plans.edit', $plan->id) }}?page={{ $plans->currentPage() }}">{{ __('plan.edit') }}</a>
                                @endhaspermission
                                @include('tenants.plans.delete', ['record' => $plan])

                            </td>
                        </tr>
                    @endforeach
                @endhaspermission
            @else
                <tr>
                    <td colspan="6" class="text-center">{{ __('general.no-record') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="container">
        {{ $plans->onEachSide(5)->links() }}
    </div>
@endsection
