@extends('layouts.panel')
@section('content')
<div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('compaign.create_compaign') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('campaigns_view')
                <a href="{{ route('campaigns.index') }}" class="btn btn-added">{{ __('compaign.campaigns') }}</a>
            @endhaspermission
        </div>
    </div>
    {{-- <div class="page-header">
        <div class="page-title">
            <h4>{{ __('compaign.create_compaign') }}</h4>
            @haspermission('view_campaigns')
                <h6>{{ __('compaign.campaigns') }} <a href="{{ route('campaigns.index') }}"
                        class="btn btn-primary">{{ __('compaign.campaigns') }}</a></h6>
            @endhaspermission

        </div>
    </div> --}}
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('campaigns.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Name --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('compaign.form.name') }}</label>
                            <?php //print_r($errors->all());
                            ?>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- Template type --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="template_type" class="">{{ __('compaign.form.type') }}</label>
                            <div class="d-flex">
                                <div>
                                    <input id="type_email" type="radio" class="@error('type') is-invalid @enderror"
                                        name="type" autocomplete="type" value="0" autofocus
                                        @checked(old('type') === 0)>
                                    <label for="type_email">{{ __('compaign.form.email') }}</label>
                                </div>
                                <div class="ms-5">
                                    <input id="type_sms" type="radio" class="@error('type') is-invalid @enderror"
                                        name="type" autocomplete="type" value="1" autofocus
                                        @checked(old('type') === 1)>
                                    <label for="type_sms">{{ __('compaign.form.sms') }}</label>
                                </div>
                            </div>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- email type --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="template_type" class="">{{ __('compaign.form.template_type') }}</label>
                            <select class="form-control" name="email_template_id" id="email_template_id">
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
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="template_type" class="">{{ __('compaign.form.user_type') }}</label>
                            <select class="form-control" name="user_type[]" id="user_type" multiple>
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
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="published_at" class="">{{ __('compaign.form.published_at') }}</label>
                            <input id="published_at" type="datetime-local"
                                class="form-control @error('published_at') is-invalid @enderror"
                                value="{{ old('published_at') }}" placeholder="published_at" name="published_at" required
                                autocomplete="published_at" autofocus>
                            @error('published_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- Status   --}}
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="status" class="">{{ __('compaign.form.status') }}</label>
                            <input id="status" type="checkbox" class="@error('status') is-invalid @enderror"
                                @checked(old('status')) name="status" autocomplete="status" autofocus>
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
                                {{ __('compaign.btn-save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
