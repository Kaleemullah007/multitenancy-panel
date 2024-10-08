@extends('layouts.panel')
@section('content')
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('user.update_profile') }}</h3>
        </div>
        <div class="page-btn">
            {{-- @haspermission('dashboard_view') --}}
                <a href="{{ route('dashboard') }}" class="btn btn-added">{{ __('user.home') }}</a>
            {{-- @endhaspermission --}}
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
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('profile.update', $profile->id) }}" enctype="multipart/form-data">
                @csrf
                                @method('PUT')

                <div class="row">
                    {{-- Name --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('user.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $profile->name) }}" name="name"placeholder="{{ __('user.form.name') }}"
                                autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="email" class="">{{ __('user.form.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $profile->email) }}" name="email" placeholder="{{ __('user.form.email') }}"
                             autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="timezone" class="">{{ __('user.form.timezone') }}</label>
                            <select class="form-control @error('timezone') is-invalid @enderror" name="timezone"
                                 placeholder="Select timezone">

                                @foreach ($timezone as $time)
                                    <option value="{{ $time->value }}" @selected($time->value == $profile->timezone)>
                                        {{ $time->name }}
                                        {{ $time->value }}</option>
                                @endforeach

                            </select>
                            @error('timezone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="dateformat" class="">{{ __('user.form.date_format') }}</label>
                            <select class="form-control @error('dateformat') is-invalid @enderror" name="dateformat"
                                 placeholder="Select date format">

                                @foreach ($dateformat as $date)
                                    <option value="{{ $date->name }}" @selected($date->value == $profile->date_format)>
                                        {{ $date->name }}
                                        {{ $date->value }}</option>
                                @endforeach

                            </select>
                            @error('dateformat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="bank_name" class="">{{ __('user.form.bank_name') }}</label>
                            <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror"
                                value="{{ old('bank_name', $bank_name) }}" name="bank_name"placeholder="{{ __('user.form.bank_name') }}">
                            @error('bank_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-6">
                        <div class="form-group">
                            <label for="is_prod" class="">{{ __('user.form.is_production') }}</label>
                            <input type="checkbox" name="is_prod" @checked(old('is_prod'))
                             class="@error('is_prod') is-invalid @enderror"
                                value="{{ old('is_prod', $profile->is_prod) }}"
                                @checked($bank_detail?->is_prod)>
                            @error('is_prod')
                                                <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-6">
                        <div class="form-group">
                            <label for="public_key" class="">{{ __('user.form.public_key') }}</label>
                            <input type="text" name="public_key" placeholder="{{ __('user.form.public_key') }}"
                             class="form-control @error('public_key') is-invalid @enderror"
                                value="{{ old('public_key', $public) }}">
                            @error('public_key')
                                                <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="private_key" class="">{{ __('user.form.private_key') }}</label>
                            <input id="private_key" type="text" class="form-control @error('private_key') is-invalid @enderror"
                                value="{{ old('private_key', $private) }}" name="private_key" placeholder="{{ __('user.form.private_key') }}">
                            @error('private_key')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="secret_key" class="">{{ __('user.form.secret_key') }}</label>
                            <input id="secret_key" type="text" class="form-control @error('secret_key') is-invalid @enderror"
                                value="{{ old('secret_key', $private) }}" name="secret_key" placeholder="{{ __('user.form.secret_key') }}">
                            @error('secret_key')
                                                <div class="error text-danger">{{ $message }}</div>

                            @enderror
                        </div>
                    </div>
                            
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password" class="">{{ __('user.form.password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                                placeholder="{{ __('user.form.password') }}" name="password">
                            @error('password')
                                                                                <div class="error text-danger">{{ $message }}</div>

                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password_confirmation"
                                class="">{{ __('user.form.password_confirm') }}</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                value="{{ old('password_confirmation') }}" placeholder="{{ __('user.form.password_confirm') }}"
                                name="password_confirmation">
                            @error('password')
                                <div class="error text-danger">{{ $message }}</div>

                            @enderror
                        </div>
                    </div>



                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="currency" class="">{{ __('user.form.currency') }}</label>
                            <select class="form-control @error('currency') is-invalid @enderror"
                                                name="currency"  placeholder="Select currency">

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
                    <div class="col-lg-5 col-sm-4 col-9">
                        <div class="form-group">
                            <label for="photo" class="">{{ __('user.form.profile_photo') }}</label>
                            <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                                name="photo" >
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @php
                    // dd($profile);    
                    @endphp
                    <div class="col-lg-1 col-sm-2 col-3">

                                        <img src="<?php echo Storage::url(tenant()->tenancy_db_name . '/app/public/' . $profile->file); ?>" class="img-fluid img-thumbnail rounded-circle ">
                    </div>
                    <div class="row mb-0 text-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('tenant.btn-update-profile') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection



