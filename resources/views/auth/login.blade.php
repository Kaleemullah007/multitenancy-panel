@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        @if (session()->has('message'))
            <div class="alert text-center alert-danger }}">
                {{ session('message') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="account-content">
                <div class="login-wrapper">
                    <div class="login-content">
                        <div class="login-userset">
                            <div class="login-logo">
                                @include('auth.logo')
                            </div>
                            <div class="login-userheading">
                                <h2 class="fw-bold mb-3">{{ __('auth.log_in') }}</h2>
                                <span class="fs-6 ">{{ __('auth.login_text') }}</span>
                            </div>
                            <div class="form-login">
                                <label for="email" class="form-label fs-6">{{ __('auth.title_email') }}</label>
                                <div class="form-addons">
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="{{ __('auth.title_email') }}" aria-label="email-address">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label for="password" class="form-label fs-6">{{ __('auth.title_password') }}</label>
                                <div class="pass-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required
                                        autocomplete="current-password" placeholder="{{ __('auth.title_password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="fas toggle-password fa-eye-slash" id="viewPassword"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <div class="alreadyuser">
                                    <h4 class="fs-6">
                                        @if (Route::has('password.request'))
                                            <a class="hover-a" href="{{ route('password.request') }}">
                                                {{ __('auth.forgot_password') }}
                                            </a>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            
                            <div class="form-login">
                                <button type="submit" class="btn btn-login fs-6">
                                    {{ __('auth.log_in') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="login-img">
                        <img src="assets/img/login.jpg" alt="img">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
