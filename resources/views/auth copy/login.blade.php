@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert text-center alert-danger }}">
            {{ session('message') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="log-in d-flex justify-content-center" style="background-image: url(/assets/img/log-in.jpg);">
            <div class="sign-in-css bg-light">

                @include('auth.logo')

                <div class="row text-center">
                    <h3>{{ __('auth.log_in') }}</h3>
                </div>
                <div class="row m-3 ">
                    <div class="col-12">
                        <label for="email-address" class="form-label fs-6">{{ __('auth.title_email') }}</label>
                    </div>
                    <div class="col-12">
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                            autocomplete="email" autofocus placeholder="Abc123@example.com" aria-label="email-address">
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
                            autocomplete="current-password" placeholder="********">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 offset-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('auth.remember_me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 justify-content-center">
                    <div class="col-8">
                        <button type="submit" class="btn btn-success rounded-pill w-100">
                            {{ __('auth.log_in') }}
                        </button>
                    </div>

                </div>
                <div class="row my-2 text-center">
                    @if (Route::has('password.request'))
                        <a class="anchor-css" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                </div>
                <div class="row mb-4 justify-content-center">
                    <div class="col-8">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-danger rounded-pill w-100">
                                {{ __('auth.register') }}
                            </a>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </form>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert text-center alert-danger }}">
                                {{ session('message') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('auth.title_email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('auth.title_password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('auth.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
