@extends('layouts.panel')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('plan.create_plan') }}</h4>
            <h6>{{ __('plan.create_plan') }} <a href="{{ route('plans.index') }}"
                    class="btn btn-primary">{{ __('plan.plans') }}</a></h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('plans.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="name" class="">{{ __('plan.form.name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" required autocomplete="name" autofocus>
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
                                name="price" required autocomplete="price" autofocus>
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
                                required autocomplete="validity_month" autofocus>
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
                                name="description" required autocomplete="description" autofocus></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('plan.btn-save') }}
                            </button>
                        </div>
                    </div>



                </div>
            </form>


        </div>
    </div>
@endsection
