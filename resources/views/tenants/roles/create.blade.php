@extends('layouts.panel')
@section('content')
<div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('role.create_role') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('roles_view')
                <a href="{{ route('roles.index') }}" class="btn btn-added">{{ __('role.roles') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('roles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Name --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('role.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0 text-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('role.btn-save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
