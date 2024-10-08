@extends('layouts.panel')
@section('content')
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('tenantuser.create_user') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('user_view')
                <a href="{{ route('plans.index') }}" class="btn btn-added">{{ __('tenantuser.user_list') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('tenantuser.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"name="name" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- email --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="email" class="">{{ __('tenantuser.form.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- roles --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="validity_month" class="">{{ __('tenantuser.form.roles') }}</label>
                            <select id="roles" type="text" class="form-control @error('roles') is-invalid @enderror"
                                name="roles[]" multiple required autocomplete="roles" autofocus>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ (is_array(old('roles')) and in_array($role->name, old('roles'))) ? ' selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach

                            </select>

                            @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{--  password --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">

                            <label for="password" class="">{{ __('tenantuser.form.password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{--  confirm password --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">

                            <label for="password_confirmation"
                                class="">{{ __('tenantuser.form.password_confirm') }}</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" required autocomplete="password_confirmation" autofocus>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0 text-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('tenantuser.btn-save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
