@extends('layouts.panel')

@section('content')
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('plan.edit_plan') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('plan_view')
                <a href="{{ route('plans.index') }}" class="btn btn-added">{{ __('plan.plans') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error') }}">
                    {{ session('message') }}
                </div>
            @endif
            <form method="POST" action="{{ route('plans.update', $plan->id) }}" enctype="multipart/form-data">
                <div class="row">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="page" id="page" value="{{ request('page') }}">

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('plan.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $plan->name) }}" name="name" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- price --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="price" class="">{{ __('plan.form.price') }}</label>
                            <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price', $plan->price) }}" name="price" required autocomplete="price" autofocus>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- Validaty --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="validity_month" class="">{{ __('plan.form.validity_month') }}</label>
                            <input id="validity_month" type="text"
                                class="form-control @error('validity_month') is-invalid @enderror" name="validity_month"
                                value="{{ old('validity_month', $plan->validity_month) }}" required autocomplete="validity_month" autofocus>
                            @error('validity_month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="status" class="">{{ __('plan.form.status') }}</label>
                            <input id="status" type="checkbox" class=" @error('status') is-invalid @enderror"
                                name="status" @checked(old('status') == true) autocomplete="status" autofocus>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{--  description --}}
                    <div class=" col-12">
                        <div class="form-group">
                            <label for="description" class="">{{ __('plan.form.description') }}</label>

                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" required autocomplete="description" autofocus>{{ old('description', $plan->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="col-lg-12 text-center ">

                        <button type="submit" class="btn btn-primary">
                            {{ __('plan.btn-edit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
