@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="log-in d-flex justify-content-center" style="background-image: url(/assets/img/log-in.jpg);">
            <div class="sign-in-css bg-light">

                @include('auth.logo')

                <div class="row text-center">
                    <h3>{{ __('auth.confirm_password') }}</h3>
                </div>
                <div class="row text-center">
                    <h6>{{ __('auth.confirm_text') }}</h6>
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
                <div class="row my-4 justify-content-center">
                    <div class="col-8">
                        <button type="submit" class="btn btn-primary rounded-pill w-100">
                            {{ __('auth.confirm_password') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('auth.forgot_password') }}
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
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
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
