@extends('layouts.panel')

@section('content')
         
 
<div class="page-header">
    <div class="page-title">
        <h4>Edit Tenant</h4>
        <h6>Create new tenant of the system  <a href="{{ route('tenants.index') }}" class="btn btn-primary">{{ __('tenant.tenants') }}</a></h6>
    </div>
</div>
        <div class="card">
            <div class="card-body">
        <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">Tenants</a>
                        @if (session()->has('message'))
                            <div class="alert text-center alert-{{ session('error') }}">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tenants.update', $tenant->id) }}"
                            enctype="multipart/form-data">
                            <div class="row">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="page" id="page" value="{{ request('page') }}">

                           <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                <label for="name"
                                    class="">{{ __('tenant.form.name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $tenant->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                <label for="email"
                                    class="">{{ __('tenant.form.email') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $tenant->email) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                <label for="domain_name"
                                    class="">{{ __('tenant.form.domain') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('domain_name') is-invalid @enderror" name="domain_name"
                                        value="{{ old('domain_name', $tenant->domains[0]->domain) }}" readonly
                                        autocomplete="domain_name" disabled autofocus>

                                    @error('domain_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--  Plans --}}

                            <div class="col-lg-3 col-sm-3 col-6">
                                <div class="form-group">
                                <label for="email"
                                    class="">{{ __('tenant.form.plan') }}</label>

                                
                                    <select id="plan_id" class="form-control @error('plan_id') is-invalid @enderror"
                                        name="plan_id" required>
                                        @foreach ($plans as $plan)
                                            <option value=" {{ $plan->id }}" @selected($tenant->plan?->id == $plan->id)
                                                @selected(old('plan_id') == $plan->id)>
                                                {{ $plan->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-3 col-sm-3 col-6">
                                <div class="form-group"> 
                                    <label for="update_plan">Update Plan ><span
                                            class="text-danger">({{ $tenant->user?->start_date }} ,
                                            {{ $tenant->user?->end_date }})</span></label>
                                    <input type="checkbox" name="update_plan" class="ml-[100px]" style="margin-left: 100px;" id="update_plan" @checked(old('update_plan') == true)>

                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                <label for="password"
                                    class="">{{ __('tenant.form.password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                <label for="password-confirm"
                                    class="">{{ __('tenant.form.password_confirm') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label> {{ __('tenant.form.profile_photo') }}</label>
                                    <div class="image-upload">
                                        <input id="file" type="file"
                                        class="form-control @error('photo') is-invalid @enderror" name="photo">
                                        @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                        <div class="image-uploads">
                                            <img src="/assets/img/icons/upload.svg" alt="img">
                                            <h4>{{ __('tenant.form.upload_description') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <div class="product-list">
                                    <ul class="row">
                                        <li class="ps-0">
                                            <div class="productviews" >
                                                <div class="productviewsimg">
                                                    <img src="<?php echo asset('/storage/app/public/' . $tenant->file); ?>" alt="img">
                                                </div>
                                                <div class="productviewscontent">
                                                    <div class="productviewsname">
                                                        <h2>macbookpro.jpg</h2>
                                                        <h3>581kb</h3>
                                                    </div>
                                                    <a href="javascript:void(0);" class="hideset">x</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center ">
                                <div class="form-group d-inline">
                                <label for="status"
                                    class="">{{ __('tenant.form.status') }} <input id="status" type="checkbox" class=" @error('status') is-invalid @enderror"
                                    name="status" @checked($tenant->status == true)></label>

                                    
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                           

                            <div class="col-lg-12 text-center ">

                                    <button type="submit" class="btn btn-primary">
                                        {{ __('tenant.btn-edit') }}
                                    </button>
                            </div>
                            </div>
                        </form>
            </div>
        </div>
        
                    
    
@endsection
