@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">Tenants</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('tenant.edit_user') }}</div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert text-center alert-{{ session('error') }}">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('tenants.update', $tenant->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $tenant->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $tenant->email) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="domain_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.domain') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('domain_name') is-invalid @enderror" name="domain_name"
                                        value="{{ old('domain_name', $tenant->domains[0]->domain) }}" readonly
                                        autocomplete="domain_name" disabled autofocus>

                                    @error('domain_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--  Plans --}}

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.plan') }}</label>

                                <div class="col-md-2">
                                    <select id="plan_id" class="form-control @error('plan_id') is-invalid @enderror"
                                        name="plan_id" required>
                                        @foreach ($plans as $plan)
                                            <option value=" {{ $plan->id }}" @selected($tenant->plan?->id == $plan->id)
                                                @selected(old('plan_id') == $plan->id)>
                                                {{ $plan->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="update_plan">Update Plan ><span
                                            class="text-danger">({{ $tenant->user?->start_date }} ,
                                            {{ $tenant->user?->end_date }})</span></label>
                                    <input type="checkbox" name="update_plan" id="update_plan" @checked(old('update_plan') == true)>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.password_confirm') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="file"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.profile_photo') }}</label>
                                <span><img src="<?php echo asset('/storage/app/public/' . $tenant->file); ?>"></span>

                                <div class="col-md-6">
                                    <input id="photo" type="file"
                                        class="form-control @error('photo') is-invalid @enderror" name="photo">
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="file"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.status') }}</label>


                                <div class="col-md-6">
                                    <input id="status" type="checkbox" class=" @error('status') is-invalid @enderror"
                                        name="status" @checked($tenant->status == true)>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('tenant.btn-edit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
