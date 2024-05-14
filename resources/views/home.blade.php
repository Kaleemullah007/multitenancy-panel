@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group list-group-horizontal flex justify-content-center">
            {{-- @haspermission('tenant_view')
                <li class="list-group-item text-decoration-none">
                    <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">{{ __('tenant.tenants') }}</a>
                </li>
            @endhaspermission

            @haspermission('plan_view')
                <li class="list-group-item text-decoration-none">
                    <a href="{{ route('plans.index') }}" class="btn btn-lg bg-primary">{{ __('plan.plans') }}</a>
                </li>
            @endhaspermission
            <li class="list-group-item text-decoration-none">
                <a href="{{ route('contacts.index') }}"
                    class="btn btn-lg bg-primary">Contacts{{ __('permission.roles') }}</a>
            </li> --}}
        </ul>
        <div class="row justify-content-center">
            @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error', 'danger') }}">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }} <a href="{{ route('file-import') }}">Import</a>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
