@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">Tenants</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('tenant.create_user') }}</div>
                    <img src="/photos/0Tujd6yAwXy6qQoH5LcylSs0EnS9vsT9TvPQBUtI.png" />
                    <img src="{{ asset('storage/app/photos/0Tujd6yAwXy6qQoH5LcylSs0EnS9vsT9TvPQBUtI.jpg') }}" />
                    <img src="<?php echo asset('/storage/app/public/photos/0Tujd6yAwXy6qQoH5LcylSs0EnS9vsT9TvPQBUtI.jpg'); ?>" />
                    <div class="card-body">
                        <form method="POST" action="{{ route('tenants.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                        value="{{ old('domain_name') }}" required autocomplete="domain_name" autofocus>

                                    @error('domain_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

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
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="file"
                                    class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.profile_photo') }}</label>


                                <div class="col-md-6">
                                    <input id="file" type="file"
                                        class="form-control @error('photo') is-invalid @enderror" name="photo">

                                </div>
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('tenant.btn-save') }}
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
