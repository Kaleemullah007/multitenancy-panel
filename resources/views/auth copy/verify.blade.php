@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="log-in d-flex justify-content-center" style="background-image: url(/assets/img/log-in.jpg);">
            <div class="sign-in-css bg-light">

                @include('auth.logo')

                <div class="row text-center">
                    <h3>{{ __('auth.verify_email') }}</h3>
                </div>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.fresh_link_sent') }}{{ __('') }}
                        </div>
                    @endif
                
                    <div class="row text-center">
                    <h6>
                        {{ __('auth.fresh_link_notice') }}
                    </h6>
                    </div>

                <div class="row my-4 justify-content-center">
                    <div class="col-8">
                        <button type="submit" class="btn btn-primary rounded-pill w-100 align-baseline">
                            {{ __('auth.request_link_btn') }}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
