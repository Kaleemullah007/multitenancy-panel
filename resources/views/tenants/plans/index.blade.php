@extends('layouts.app')
@section('content')
    @haspermission('plan_create')
        <a class="btn btn-lg bg-primary" href="{{ route('plans.create') }}">{{ __('plan.create') }}</a>
    @endhaspermission
    <table class="table">
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
            @haspermission('plan_view')
                @foreach ($plans as $key => $plan)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->description }}</td>
                        <td>{{ $plan->validity_month }}</td>
                        <td>{{ $plan->price }}</td>
                        <td>
                            @haspermission('plan_edit')
                                <a href="{{ route('plans.edit', $plan->id) }}">{{ __('plan.edit') }}</a>
                            @endhaspermission
                            @include('tenants.plans.delete', ['record' => $plan])

                        </td>
                    </tr>
                @endforeach
            @endhaspermission
        </tbody>
    </table>
    <div class="container">
        {{ $plans->onEachSide(5)->links() }}
    </div>
@endsection
