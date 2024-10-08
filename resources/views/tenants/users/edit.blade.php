@extends('layouts.panel')

@section('content')
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('tenantuser.edit_user') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('user_view')
                <a href="{{ route('users.index') }}" class="btn btn-added">{{ __('tenantuser.user_list') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- @haspermission('plan_view')
                <a href="{{ route('plans.index') }}" class="btn btn-lg bg-primary">Plans</a>
            @endhaspermission --}}
            {{-- @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error') }}">
                    {{ session('message') }}
                </div>
            @endif --}}
            <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                <div class="row">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="page" id="page" value="{{ request('page') }}">

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('tenantuser.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}"name="name" required autocomplete="name" autofocus>
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
                                value="{{ old('email', $user->email) }}" name="email" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    @php
                                $user_roles = $user->roles->pluck('name')->toArray();
                                $user_permissions = $user->permissions->pluck('name')->toArray();
                    @endphp

                    {{-- roles --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="validity_month" class="">{{ __('tenantuser.form.roles') }}</label>
                                    <select id="roles" type="text"
                                        class="form-control @error('roles') is-invalid @enderror" name="roles[]" multiple
                                        required autocomplete="roles" autofocus>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ in_array($role->name, $user_roles) ? 'selected' : '' }}>
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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" autocomplete="password">
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
                                                        
                            <label for="password_confirmation" class="">{{ __('tenantuser.form.password_confirm') }}</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" autocomplete="password_confirmation">
                        </div>
                    </div>

                    <div class="col-lg-12 text-center ">

                        <button type="submit" class="btn btn-primary">
                            {{ __('tenantuser.btn-edit') }}
                        </button>
                    </div>
                </div>
            </form>
                    
        </div>
    </div>
@endsection

