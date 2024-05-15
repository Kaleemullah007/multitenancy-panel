@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ route('home') }}" class="btn btn-primary">

                            {{ __('user.home') }}
                        </a> {{ __('user.update_profile') }}</div>

                    @php
                        $public = '';
                        $secret = '';
                        $private = '';
                        $bank_name = '';

                        if (!is_null($bank_detail)) {
                            $public = $bank_detail?->t_public_key;
                            $secret = $bank_detail?->t_secret_key;
                            $private = $bank_detail?->t_private_key;
                            $bank_name = $bank_detail?->bank_name;
                            if ($bank_detail->is_prod) {
                                $public = $bank_detail?->public_key;
                                $secret = $bank_detail?->secret_key;
                                $private = $bank_detail?->private_key;
                            }
                        }

                    @endphp

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
                                            <label class="far fa-envelope-open">{{ __('user.form.timezone') }}</label>
                                            <select class="form-control @error('timezone') is-invalid @enderror"
                                                name="timezone" required="required" placeholder="Select timezone">

                                                @foreach ($timezone as $time)
                                                    <option value="{{ $time->value }}" @selected($time->value == $profile->timezone)>
                                                        {{ $time->name }}
                                                        {{ $time->value }}</option>
                                                @endforeach

                                            </select>
                                            @error('timezone')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6 md-mb-30 mt-2">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-envelope-open">{{ __('user.form.date_format') }}</label>
                                            <select class="form-control @error('timezone') is-invalid @enderror"
                                                name="timezone" required="required" placeholder="Select timezone">

                                                @foreach ($dateformat as $date)
                                                    <option value="{{ $date->name }}" @selected($date->value == $profile->date_format)>
                                                        {{ $date->name }}
                                                        {{ $date->value }}</option>
                                                @endforeach

                                            </select>
                                            @error('timezone')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>



                                    <div class="col-md-6 md-mb-30 mt-2">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-eye">{{ __('user.form.bank_name') }}</label>
                                            <input type="text" name="bank_name" placeholder="bank_name"
                                                value="{{ old('bank_name', $bank_name) }}"
                                                class="form-control @error('bank_name') is-invalid @enderror">
                                            @error('bank_name')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-2 md-mb-30 mt-1 ">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-eye">{{ __('user.form.is_production') }}</label><br>
                                            <input type="checkbox" name="is_prod" @checked(old('is_prod'))
                                                class="mt-2 @error('is_prod') is-invalid @enderror"
                                                @checked($bank_detail?->is_prod)>
                                            @error('is_prod')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 md-mb-30">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-eye">{{ __('user.form.public_key') }}</label>
                                            <input type="text" name="public_key" placeholder="Private Key"
                                                value="{{ old('public_key', $public) }}"
                                                class="form-control @error('public_key') is-invalid @enderror">
                                            @error('public_key')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6 md-mb-30">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-eye">{{ __('user.form.private_key') }}</label>
                                            <input type="text" name="private_key" placeholder="Private Key"
                                                value="{{ old('private_key', $private) }}"
                                                class="form-control @error('private_key') is-invalid @enderror">
                                            @error('private_key')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 md-mb-30">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-eye">{{ __('user.form.secret_key') }}</label>
                                            <input type="text" name="secret_key" placeholder="secret_key"
                                                value="{{ old('secret_key', $secret) }}"
                                                class="form-control @error('secret_key') is-invalid @enderror">
                                            @error('secret_key')
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
                                    <div class="col-md-6 md-mb-30 mt-2">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <label class="far fa-envelope-open">{{ __('user.form.currency') }}</label>
                                            <select class="form-control @error('currency') is-invalid @enderror"
                                                name="currency" required="required" placeholder="Select currency">

                                                @php
                                                    $currencies = ['pkr', 'usd', 'aed'];
                                                @endphp
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency }}" @selected($currency == $profile->currency)>
                                                        {{ $currency }}</option>
                                                @endforeach



                                            </select>
                                            @error('currency')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>

                                    </div>
                                    {{-- <div class="row flex"> --}}
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
                                        <img src="<?php echo Storage::url(tenant()->tenancy_db_name . '/app/public/' . $profile->file); ?>" class="img-fluid img-thumbnail rounded-circle ">
                                    </div>

                                    {{-- </div> --}}

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
