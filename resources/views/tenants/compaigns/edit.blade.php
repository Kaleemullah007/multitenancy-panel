@extends('layouts.panel')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('compaign.edit_compaign') }}</h4>
            <h6>{{ __('compaign.edit_compaign') }} of the system
                @haspermission('campaigns_view')
                    <a href="{{ route('campaigns.index') }}"
                        class="btn btn-primary">{{ __('compaign.campaigns') }}</a>
                @endhaspermission
            </h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- @haspermission('campaign_view')
                <a href="{{ route('campaigns.index') }}" class="btn btn-lg bg-primary">campaigns</a>
            @endhaspermission --}}
            @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error') }}">
                    {{ session('message') }}
                </div>
            @endif
            <form method="POST" action="{{ route('campaigns.update', $campaign->id) }}"
                enctype="multipart/form-data">
                <div class="row">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="page" id="page" value="{{ request('page') }}">
                    {{-- Name --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('compaign.form.name') }}</label>
                            <?php //print_r($errors->all());
                            ?>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $campaign->name) }}" name="name" required autocomplete="name" autofocus>
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
                                        @checked(old('type', $campaign->type->value) == 0)>
                                    <label for="type_email">Email</label>
                                </div>
                                <div class="ms-5">
                                    <input id="type_sms" type="radio" class="@error('type') is-invalid @enderror"
                                        name="type" autocomplete="type" value="1" autofocus
                                        @checked(old('type', $campaign->type->value) == 1)>
                                    <label for="type_sms">SMS</label>
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
                                    <option value="{{ $email->id }}" @selected($campaign->email_tempplate_id == $email->id)>
                                        {{ $email->subject }}</option>
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
                                    <option value="{{ $role->name }}" @selected(in_array($role->name, explode(',', $campaign->user_type)))>
                                        {{ $role->name }}
                                    </option>
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
                                value="{{ old('published_at', Carbon\Carbon::parse($email->published_at)->format('Y-m-d\TH:i:s')) }}"
                                placeholder="published_at" name="published_at" required
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
                                @checked(old('status', $campaign->status)) name="status" autocomplete="status" autofocus>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 text-center ">

                        <button type="submit" class="btn btn-primary">
                            {{ __('compaign.btn-edit') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

