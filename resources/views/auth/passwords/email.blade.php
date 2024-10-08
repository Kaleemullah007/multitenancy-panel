@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="account-content">
                <div class="login-wrapper">
                    <div class="login-content">
                        <div class="login-userset">
                            <div class="login-logo">
                                @include('auth.logo')
                            </div>
                            <div class="login-userheading">
                                <h2 class="fw-bold mb-3">{{ __('auth.reset_password') }}</h2>
                                {{-- <span class="fs-6 ">{{ __('auth.login_text') }}</span> --}}
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
                                    <img src="/assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>

                            <div class="form-login">
                                <button type="submit" class="btn btn-login fs-6">
                                    {{ __('auth.send_password_link') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="login-img">
                        <img src="/assets/img/login.jpg" alt="img">
                    </div>
                </div>
            </div>
        </form>
        
    </div>
@endsection


