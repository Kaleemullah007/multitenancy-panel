@extends('layouts.panel')
@section('content')
    <div class="page-header">
        <div class="page-title d-flex ">
            <h4>{{ __('user.update_profile') }}</h4>
            {{-- @haspermission('view_roles') --}}
            {{-- <h6>{{ __('user.home') }}  --}}
            <a href="{{ route('dashboard') }}" class="btn btn-primary">{{ __('user.home') }}</a>
            {{-- </h6> --}}
            {{-- @endhaspermission --}}

        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('profile.update', $profile->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- Name --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('user.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $profile->name) }}" name="name"placeholder="Full Name" required
                                autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="email" class="">{{ __('user.form.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $profile->email) }}" name="email" placeholder="Email Address"
                                required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password" class="">{{ __('user.form.password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                                placeholder="Password" name="password" required autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password_confirmation"
                                class="">{{ __('user.form.password_confirm') }}</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                value="{{ old('password_confirmation') }}" placeholder="Confirm Password"
                                name="password_confirmation" required autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="photo" class="">{{ __('tenant.form.profile_photo') }}</label>
                            <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                                name="photo">
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1 col-3">
                        <img src="<?php echo Storage::url('app/public/' . $profile->file); ?>" class="img-fluid img-thumbnail rounded-circle ">

                    </div>



                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('tenant.btn-update-profile') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
