@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ route('home') }}" class="btn btn-primary">

                            Home
                        </a> Update Profile</div>

                    <div class="card-body">
                        <div class="getIn__touch-left-form">
                            <form action="{{ route('profile.update', $profile->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-30">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <span class="fas fa-user"> {{ __('user.form.name') }}</span>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Full Name" required="required"
                                                value="{{ old('name', $profile->name) }}">
                                            @error('name')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 md-mb-30">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <span class="far fa-envelope-open"> {{ __('user.form.email') }}</span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" placeholder="Email Address" required="required"
                                                value="{{ old('email', $profile->email) }}">
                                            @error('email')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 md-mb-30 mt-2">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-eye">{{ __('user.form.password') }}</label>
                                            <input type="password" name="password" placeholder="Password"
                                                value="{{ old('password') }}"
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>





                                    <div class="col-md-6 md-mb-30 mt-2">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-eye">{{ __('user.form.password_confirm') }}</label>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm Password" value="{{ old('password_confirmation') }}"
                                                class="form-control @error('password_confirmation') is-invalid @enderror">
                                            @error('password_confirmation')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-5 md-mb-30 mt-2">
                                        <label for="photo"
                                            class="col-md-4 col-form-label text-md-end">{{ __('tenant.form.profile_photo') }}</label>
                                        <div class="col-md-9">
                                            <input id="photo" type="file"
                                                class="form-control @error('photo') is-invalid @enderror" name="photo">
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-4">
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
                </div>
            </div>
        </div>
    </div>
@endsection
