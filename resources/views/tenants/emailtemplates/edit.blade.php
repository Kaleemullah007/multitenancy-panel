@extends('layouts.panel')

@section('content')
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('emailtemplate.edit_emailtemplate') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('emailtemplates_view')
                <a href="{{ route('emailtemplates.index') }}" class="btn btn-added">{{ __('emailtemplate.emailtemplates') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- @haspermission('emailtemplate_view')
                <a href="{{ route('emailtemplates.index') }}" class="btn btn-lg bg-primary">emailtemplates</a>
            @endhaspermission --}}
            @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error') }}">
                    {{ session('message') }}
                </div>
            @endif
            <form method="POST" action="{{ route('emailtemplates.update', $emailtemplate->id) }}"
                enctype="multipart/form-data">
                <div class="row">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="page" id="page" value="{{ request('page') }}">
                    {{-- Subject --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="subject" class="">{{ __('emailtemplate.form.subject') }}</label>
                            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                                value="{{ old('subject', $emailtemplate->subject) }}" name="subject" required
                                autocomplete="subject" autofocus>
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
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $emailtemplate->title) }}" name="title" required
                                autocomplete="title" autofocus>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#placeholderModel">
                                {{ __('emailtemplate.form.placeholder') }}
                            </button>
                            <textarea id="body" type="text" class="form-control mt-2 @error('body') is-invalid @enderror" name="body">{{ old('body', $emailtemplate->body) }}</textarea>
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
                            <input id="template_type_email" type="checkbox"
                                class="@error('template_type') is-invalid @enderror" name="template_type"
                                autocomplete="template_type" autofocus @checked($emailtemplate->template_type->value == 0)>
                            {{ __('emailtemplate.form.email') }}
                            <input id="template_type_sms" type="checkbox"
                                class="ms-5 @error('template_type') is-invalid @enderror" name="template_type"
                                autocomplete="template_type" autofocus value="1" @checked($emailtemplate->template_type->value == 1)>
                            {{ __('emailtemplate.form.sms') }}
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
                            <input id="status" type="checkbox" class="@error('status') is-invalid @enderror"
                                name="status" @checked($emailtemplate->status) autocomplete="status" autofocus>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 text-center ">

                        <button type="submit" class="btn btn-primary">
                            {{ __('emailtemplate.btn-edit') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection



