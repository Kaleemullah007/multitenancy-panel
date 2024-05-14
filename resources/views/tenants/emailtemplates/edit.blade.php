@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('emailtemplate.edit_emailtemplate') }}</div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert text-center alert-{{ session('error') }}">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('emailtemplates.update', $emailtemplate->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="subject"
                                    class="col-md-4 col-form-label text-md-end">{{ __('emailtemplate.form.subject') }}</label>

                                <div class="col-md-6">
                                    <input id="subject" type="text"
                                        class="form-control @error('subject') is-invalid @enderror" name="subject"
                                        value="{{ old('subject', $emailtemplate->subject) }}" required
                                        autocomplete="subject" autofocus>

                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Title --}}

                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('emailtemplate.form.title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ old('title', $emailtemplate->title) }}" autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Template --}}
                            {{-- Template --}}
                            <div class="row mb-3">
                                <label for="body"
                                    class="col-md-4 col-form-label text-md-end">{{ __('emailtemplate.form.body') }}

                                </label>
                                <!-- Button trigger modal -->

                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#placeholderModel">
                                        Placeholders
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
                            <div class="row mb-3">
                                <label for="template_type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('emailtemplate.form.template_type') }}</label>

                                <div class="col-md-6">
                                    <input id="template_type_email" type="radio"
                                        class="@error('template_type') is-invalid @enderror" name="template_type"
                                        autocomplete="template_type" autofocus @checked($emailtemplate->template_type->value == 0)>
                                    <label for="template_type_email">Email</label>
                                    <input id="template_type_sms" type="radio"
                                        class="@error('template_type') is-invalid @enderror" name="template_type"
                                        autocomplete="template_type" autofocus value="1" @checked($emailtemplate->template_type->value == 1)>
                                    <label for="template_type_sms">SMS</label>


                                    @error('template_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Status   --}}
                            <div class="row mb-3">
                                <label for="status"
                                    class="col-md-4 col-form-label text-md-end">{{ __('emailtemplate.form.status') }}</label>

                                <div class="col-md-6">
                                    <input id="status" type="checkbox" class="@error('status') is-invalid @enderror"
                                        name="status" @checked($emailtemplate->status) autocomplete="status" autofocus>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('emailtemplate.btn-edit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('tenants.emailtemplates.modal')
@endsection
