@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        <form method="POST" action="{{ route('register') }}">
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
                                <h2 class="fw-bold mb-3">{{ __('auth.register') }}</h2>
                                <span class="fs-6 ">{{ __('auth.register_text') }}</span>
                            </div>
                            <div class="form-login">
                                <label for="name" class="form-label fs-6">{{ __('auth.title_name') }}</label>
                                <div class="form-addons">
                                    <input type="name" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required autocomplete="name" autofocus placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label for="email" class="form-label fs-6">{{ __('auth.title_email') }}</label>
                                <div class="form-addons">
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Abc123@example.com" aria-label="email-address">
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
                                <label for="password-confirm"
                                    class="form-label fs-6">{{ __('auth.confirm_password') }}</label>
                                <div class="pass-group">
                                    <input type="password" id="password-confirm" name="password_confirmation"
                                        class="form-control" required autocomplete="new-password" placeholder="********">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-register">
                                <button type="submit" class="btn btn-login fs-6">
                                    {{ __('auth.register') }}
                                </button>
                            </div>
                            <div class="form-setlogin">
                                <h4>{{ __('auth.login_divider') }}</h4>
                            </div>
                            <div class="form-login">
                                <a class="btn btn-login" href="#">
                                    {{ __('auth.log_in') }}
                                </a>
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


@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="log-in d-flex justify-content-center" style="background-image: url(/assets/img/log-in.jpg);">
            <div class="sign-in-css bg-light">

                @include('auth.logo')

                <div class="row text-center">
                    <h3>{{ __('auth.register') }}</h3>
                </div>
                <div class="row m-3 ">
                    <div class="col-12">
                        <label for="name" class="form-label fs-6">{{ __('auth.title_name') }}</label>
                    </div>
                    <div class="col-12">
                        <input type="name" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                            autocomplete="name" autofocus placeholder="Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="row m-3 ">
                    <div class="col-12">
                        <label for="email" class="form-label fs-6">{{ __('auth.title_email') }}</label>
                    </div>
                    <div class="col-12">
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            required autocomplete="email" autofocus placeholder="Abc123@example.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="row m-3 ">
                    <div class="col-12">
                        <label for="password" class="form-label fs-6">{{ __('auth.title_password') }}</label>
                    </div>
                    <div class="col-12">
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required
                            autocomplete="new-password" placeholder="********">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row m-3 ">
                    <div class="col-12">
                        <label for="password-confirm" class="form-label fs-6">{{ __('auth.confirm_password') }}</label>
                    </div>
                    <div class="col-12">
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control"
                            required autocomplete="new-password" placeholder="********">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row my-4 justify-content-center">
                    <div class="col-8">
                        <button type="submit" class="btn btn-success rounded-pill w-100">
                            {{ __('auth.register') }}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
