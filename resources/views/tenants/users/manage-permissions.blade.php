@extends('layouts.panel')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('tenantuser.user_title', ['user' => ucfirst($user->name)]) }}</h4>
            {{-- @haspermission('view_users') --}}
            {{-- <h6>{{ __('tenantuser.create_plan') }} <a href="{{ route('users.index') }}"
                    class="btn btn-primary">{{ __('tenantuser.users') }}</a></h6> --}}
            {{-- @endhaspermission --}}

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error') }}">
                    {{ session('message') }}
                </div>
            @endif
            <form method="POST" action="{{ route('users.save-permissions', encrypt($user->id)) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="roles" class="">{{ __('tenantuser.form.roles') }}</label>
                            @php
                                $user_roles = $user->roles->pluck('name')->toArray();
                                $user_permissions = $user->permissions->pluck('name')->toArray();
                            @endphp

                            <select id="roles" type="text" class="form-control @error('roles') is-invalid @enderror"
                                name="roles[]" multiple required autocomplete="roles" autofocus>
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
                </div>
                <div class="d-flex">
                    <div class="col-sm-4">
                        <label for="name" class=" text-md-center fw-bold fs-4">{{ __('Permissions') }}</label>

                    </div>
                    <div class="col-sm-4">
                        <input type="checkbox" name="checkedAll" id="checkAll" />
                        <label for="checkAll" class="fw-bold">Select All</label>
                    </div>
                </div>
                <div class="row">

                    @foreach ($permissions as $permission)
                        <div class="col-sm-6">
                            <label for="{{ $permission->name }}" class="col-md-6 col-form-label text-md-start">
                                {{ $permission->name }}</label>
                            <input type="checkbox" class=" @error('permissions') is-invalid @enderror" name="permissions[]"
                                value="{{ $permission->name }}" id="{{ $permission->name }}" autocomplete="permissions"
                                {{ in_array($permission->name, $user_permissions) ? 'checked' : '' }}>

                            @error('permissions')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('tenantuser.btn_role_permission') }}
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection

