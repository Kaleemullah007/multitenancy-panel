@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage ' . $user->name . ' Permissions') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.save-permissions', encrypt($user->id)) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                                @php
                                    $user_roles = $user->roles->pluck('name')->toArray();
                                    $user_permissions = $user->permissions->pluck('name')->toArray();
                                @endphp


                                <div class="col-md-2">
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
                            <div class="col-sm-4">
                                <label for="name"
                                    class=" text-md-center text-bold display-4">{{ __('Permissions') }}</label>

                            </div><input type="checkbox" name="checkedAll" id="checkAll" /> <label for="checkAll"
                                class="fw-bold">
                                Select
                                All</label>
                            <div class="row">

                                @foreach ($permissions as $permission)
                                    <div class="col-sm-6">
                                        <label for="{{ $permission->name }}" class="col-md-4 col-form-label text-md-start">
                                            {{ $permission->name }}</label>
                                        <input type="checkbox" class=" @error('permissions') is-invalid @enderror"
                                            name="permissions[]" value="{{ $permission->name }}"
                                            id="{{ $permission->name }}" autocomplete="permissions"
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
                                        {{ __('Update Permissions and Role') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
