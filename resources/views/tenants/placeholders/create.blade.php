@extends('layouts.panel')
@section('content')
<div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('placeholder.create_placeholder') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('placeholders_view')
                <a href="{{ route('placeholders.index') }}" class="btn btn-added">{{ __('placeholder.placeholders') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('placeholders.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('placeholder.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"name="name" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="key_name" class="">{{ __('placeholder.form.key_name') }}</label>
                            <input id="key_name" type="text" class="form-control @error('key_name') is-invalid @enderror"
                                value="{{ old('key_name') }}" name="key_name" required autocomplete="key_name" autofocus>
                            @error('key_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0 text-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('placeholder.btn-save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
