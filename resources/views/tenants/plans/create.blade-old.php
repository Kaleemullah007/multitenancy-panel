@extends('layouts.app')

@section('content') 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('plan.create_plan') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('plans.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('plan.form.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--  Description --}}
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('plan.form.description') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                        name="description" autocomplete="description" autofocus>{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- price --}}
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('plan.form.price') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ old('price') }}" required autocomplete="price" autofocus>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Validaty --}}
                            <div class="row mb-3">
                                <label for="validity_month"
                                    class="col-md-4 col-form-label text-md-end">{{ __('plan.form.validity_month') }}</label>
                                <div class="col-md-6">
                                    <input id="validity_month" type="text"
                                        class="form-control @error('validity_month') is-invalid @enderror"
                                        name="validity_month" value="{{ old('validity_month') }}" required
                                        autocomplete="validity_month" autofocus>

                                    @error('validity_month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status"
                                    class="col-md-4 col-form-label text-md-end">{{ __('plan.form.status') }}</label>
                                <div class="col-md-6">
                                    <input id="status" type="checkbox" class=" @error('status') is-invalid @enderror"
                                        name="status" @checked(old('status') == true) autocomplete="status" autofocus>

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
                                        {{ __('plan.btn-save') }}
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
