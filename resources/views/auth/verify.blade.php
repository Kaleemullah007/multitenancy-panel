@extends('layouts.app')

@section('content')
    <div class="main-wrapper">
        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.fresh_link_sent') }}
                        </div>
                    @endif

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <div class="account-content">
                <div class="login-wrapper">
                    <div class="login-content">
                        <div class="login-userset">
                            <div class="login-logo">
                                @include('auth.logo')
                            </div>
                            <div class="login-userheading">
                                <h2 class="fw-bold mb-3">{{ __('auth.verification') }}</h2>
                                <span class="fs-6 ">{{ __('auth.verify_email') }}</span>
                            </div>
                            
                            {{ __('auth.fresh_link_notice') }}
                            <div class="form-login">
                                <button type="submit" class="btn btn-login fs-6">
                                    {{ __('auth.request_link_btn') }}
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

