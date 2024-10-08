@extends('layouts.panel')

@section('content')
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('role.edit_role') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('roles_view')
                <a href="{{ route('roles.index') }}" class="btn btn-added">{{ __('role.roles') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- @haspermission('role_view')
                <a href="{{ route('roles.index') }}" class="btn btn-lg bg-primary">roles</a>
            @endhaspermission --}}
            @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error') }}">
                    {{ session('message') }}
                </div>
            @endif
            <form method="POST" action="{{ route('roles.update', $role->id) }}"
                enctype="multipart/form-data">
                <div class="row">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="page" id="page" value="{{ request('page') }}">
                    {{-- Name --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('role.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $role->name) }}" name="name" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 text-center ">

                        <button type="submit" class="btn btn-primary">
                            {{ __('role.btn-edit') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection


