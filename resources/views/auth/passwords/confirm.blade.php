@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
        <input type="hidden" name="token" value="{{ $token }}">
            <div class="account-content">
                <div class="login-wrapper">
                    <div class="login-content">
                        <div class="login-userset">
                            <div class="login-logo">
                                @include('auth.logo')
                            </div>
                            <div class="login-userheading">
                                <h2 class="fw-bold mb-3">{{ __('auth.confirm_password') }}</h2>
                                <span class="fs-6 ">{{ __('auth.confirm_text') }}</span>
                            </div>
                            <div class="form-login">
                                <label for="password" class="form-label fs-6">{{ __('auth.title_password') }}</label>
                                <div class="pass-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required
                                        autocomplete="current-password" placeholder="Enter your password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            
                            <div class="form-login">
                                <button type="submit" class="btn btn-login fs-6">
                                    {{ __('auth.confirm_password') }}
                                </button>
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

