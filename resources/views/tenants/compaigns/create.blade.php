@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('compaign.create_compaign') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('campaigns.store') }}">
                            @csrf
                            {{-- Name --}}
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('compaign.form.name') }}</label>


                                <?php //print_r($errors->all());
                                ?>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Template type --}}
                            <div class="row mb-3">
                                <label for="template_type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('compaign.form.type') }}</label>

                                <div class="col-md-6">
                                    <input id="type_email" type="radio" class="@error('type') is-invalid @enderror"
                                        name="type" autocomplete="type" value="0" autofocus
                                        @checked(old('type') === 0)>
                                    <label for="type_email">Email</label>
                                    <input id="type_sms" type="radio" class="@error('type') is-invalid @enderror"
                                        name="type" autocomplete="type" autofocus value="1"
                                        @checked(old('type') === 1)>
                                    <label for="type_sms">SMS</label>


                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- Template type --}}
                            <div class="row mb-3">
                                <label for="template_type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('compaign.form.template_type') }}</label>

                                <div class="col-md-6">

                                    <select name="email_template_id" id="email_template_id">
                                        @foreach ($emails as $email)
                                            <option value="{{ $email->id }}">{{ $email->subject }}</option>
                                        @endforeach

                                    </select>
                                    @error('email_template_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- User type --}}
                            <div class="row mb-3">
                                <label for="template_type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('compaign.form.user_type') }}</label>

                                <div class="col-md-6">

                                    <select name="user_type[]" id="user_type" multiple>
                                        <option value="all">All</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Published at   --}}
                            <div class="row mb-3">
                                <label for="published_at"
                                    class="col-md-4 col-form-label text-md-end">{{ __('compaign.form.published_at') }}</label>

                                <div class="col-md-6">
                                    <input type="datetime-local" id="published_at" placeholder="published_at"
                                        class="@error('published_at') is-invalid @enderror" name="published_at"
                                        value="{{ old('published_at') }}" autocomplete="published_at" autofocus>

                                    @error('published_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status   --}}
                            <div class="row mb-3">
                                <label for="status"
                                    class="col-md-4 col-form-label text-md-end">{{ __('compaign.form.status') }}</label>

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
                                        {{ __('compaign.btn-save') }}
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
