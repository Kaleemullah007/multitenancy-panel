@extends('layouts.panel')
@section('content')
<div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('emailtemplate.create_emailtemplate') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('emailtemplates_view')
                <a href="{{ route('emailtemplates.index') }}" class="btn btn-added">{{ __('emailtemplate.emailtemplates') }}</a>
            @endhaspermission
        </div>
    </div>
<div class="card">
    <div class="card-body">

        <form method="POST" action="{{ route('emailtemplates.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Subject --}}
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="subject" class="">{{ __('emailtemplate.form.subject') }}</label>
                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" name="subject" required autocomplete="subject" autofocus>
                        @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- Title --}}
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="title" class="">{{ __('emailtemplate.form.title') }}</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" required autocomplete="title" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- body --}}
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="body" class="">{{ __('emailtemplate.form.body') }}</label>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#placeholderModel">
                            {{ __('emailtemplate.form.placeholder') }}
                        </button>
                        <textarea id="body" type="text" class="form-control mt-2 @error('body') is-invalid @enderror" name="body">{{ old('body') }}</textarea>
                        @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- Template type --}}
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="template_type" class="">{{ __('emailtemplate.form.template_type') }}</label>
                        <input id="template_type" type="checkbox" class="@error('template_type') is-invalid @enderror" name="template_type" value="{{ old('template_type') }}" autocomplete="template_type" autofocus value="0" @checked(old('status'))>{{ __('emailtemplate.form.email') }}
                        <input id="template_type" type="checkbox" class="@error('template_type') is-invalid @enderror" name="template_type" value="{{ old('template_type') }}" autocomplete="template_type" autofocus value="1" @checked(old('status')==1)>{{ __('emailtemplate.form.sms') }}
                        @error('template_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- Status   --}}
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="status" class="">{{ __('emailtemplate.form.status') }}</label>
                        <input id="status" type="checkbox" class="@error('status') is-invalid @enderror" @checked(old('status')) name="status" autocomplete="status" autofocus>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-0 text-center">
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            {{ __('emailtemplate.btn-save') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@include('tenants.emailtemplates.modal')

@endsection

@section('scripts')

@endsection