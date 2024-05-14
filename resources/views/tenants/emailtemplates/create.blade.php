@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('emailtemplate.create_emailtemplate') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('emailtemplates.store') }}">
                            @csrf
                            {{-- Subject --}}
                            <div class="row mb-3">
                                <label for="subject"
                                    class="col-md-4 col-form-label text-md-end">{{ __('emailtemplate.form.subject') }}</label>

                                <div class="col-md-6">
                                    <input id="subject" type="text"
                                        class="form-control @error('subject') is-invalid @enderror" name="subject"
                                        value="{{ old('subject') }}" autocomplete="subject" autofocus>

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
                                        value="{{ old('title') }}" autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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
                                    <textarea id="body" type="text" class="form-control mt-2 @error('body') is-invalid @enderror" name="body">{{ old('body') }}</textarea>
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
                                    <input id="template_type" type="checkbox"
                                        class="@error('template_type') is-invalid @enderror" name="template_type"
                                        value="{{ old('template_type') }}" autocomplete="template_type" autofocus
                                        value="0" @checked(old('status'))> Email
                                    <input id="template_type" type="checkbox"
                                        class="@error('template_type') is-invalid @enderror" name="template_type"
                                        value="{{ old('template_type') }}" autocomplete="template_type" autofocus
                                        value="1" @checked(old('status') == 1)> SMS


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
                                        name="status" @checked(old('status')) autocomplete="status" autofocus>

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
                                        {{ __('emailtemplate.btn-save') }}
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
