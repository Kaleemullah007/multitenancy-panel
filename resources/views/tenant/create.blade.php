@extends('layouts.panel')

@section('content')


    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('tenant.create_user') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('tenant_view')
                <a href="{{ route('tenants.index') }}" class="btn btn-added">{{ __('tenant.tenants') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('tenants.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('tenant.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="email" class="">{{ __('tenant.form.email') }}</label>


                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    {{--  Plans --}}

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="email" class="">{{ __('tenant.form.plan') }}</label>
                            <select id="plan_id" class="form-control select @error('plan_id') is-invalid @enderror"
                                name="plan_id" required>
                                @foreach ($plans as $plan)
                                    <option value=" {{ $plan->id }}" @selected(old('plan_id') == $plan->id)>
                                        {{ $plan->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="domain_name" class="">{{ __('tenant.form.domain') }}</label>
                            <input id="domain_name" type="text"
                                class="form-control @error('domain_name') is-invalid @enderror" name="domain_name"
                                value="{{ old('domain_name') }}" required autocomplete="domain_name" autofocus>

                            @error('domain_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password" class="">{{ __('tenant.form.password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="password-confirm" class="">{{ __('tenant.form.password_confirm') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> {{ __('tenant.form.profile_photo') }}</label>
                            <div class="image-upload">
                                <input id="file" type="file"
                                    class="form-control @error('photo') is-invalid @enderror" name="photo">
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="image-uploads">
                                    <img src="/assets/img/icons/upload.svg" alt="img">
                                    <h4>{{ __('tenant.form.upload_description') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0 text-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-added">
                                {{ __('tenant.btn-save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection
