@extends('layouts.panel')
@section('content')

<div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('contact.contact_us') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('dashboard_view')
                <a href="{{ route('dashboard') }}" class="btn btn-added">{{ __('contact.dashboard') }}</a>
            @endhaspermission
        </div>
    </div>
    <div class="card">
        <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert text-center alert-{{ session('error', 'success') }}">
                                {{ session('message') }}
                            </div>
                        @endif

            <form action="{{ route('contactus.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        {{-- <span class="fas fa-user"></span> --}}
                                        <label class="mb-2" for="name">{{ __('contact.form.name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Full Name" required="required"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 md-mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        {{-- <span class="far fa-envelope-open"></span> --}}
                                        <label class="mb-2" for="email">{{ __('contact.form.email') }}</label>
                                        <input type="email" name="email" placeholder="Email Address" required="required"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 md-mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        {{-- <span class="fas fa-book"></span> --}}
                                        <label class="mb-2" for="subject">{{ __('contact.table.subject') }}</label>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                            name="subject" placeholder="Subject" value="{{ old('subject') }}">
                                        @error('subject')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6 md-mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        {{-- <span class="far fa-envelope-open"></span> --}}
                                        <label class="mb-2" for="photo">{{ __('contact.form.photo') }}</label>
                                        <input type="file" name="photo"
                                            class="form-control @error('photo') is-invalid @enderror"
                                            value="{{ old('photo') }}">
                                        @error('photo')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        {{-- <span class="far fa-comments"></span> --}}
                                        <label class="mb-2" for="message">{{ __('contact.table.message') }}</label>
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row justify-content-center text-center mb-4 mt-4">
                                    <div class="col-lg-6">
                                        {{-- <span class="far fa-comments"></span> --}}
                                        {{-- <div class="col-md-12"> --}}
                                            <label class="mb-2" for="captache">{{ __('contact.enter_captache') }}</label>
                                        {{-- </div> --}}
                                        <div class="d-flex">
                                            <input type="text" name="captache"
                                                class="form-control text-black border-danger mb-3 me-5  @error('captache') is-invalid @enderror"
                                                value="">
                                            @error('captache')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        {{-- </div> --}}
                                        {{-- <div class="col-md-3"> --}}
                                            <img src="{{ route('contactus.loadCapatche') }}" alt=""
                                                class="dimg-fluid" width="120" height="">
                                        </div>
                                        
                                    </div>


                                </div>

                                <div class="text-center ">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('contact.form.reply') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>


        </div>
    </div>
@endsection


{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}sdfa</div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert text-center alert-{{ session('error', 'danger') }}">
                                {{ session('message') }}
                            </div>
                        @endif

                        <ul class="list-group list-group-horizontal">
                            @foreach (config('localizations.locales') as $locale)
                                <li
                                    class="list-group-item list-group-item list-group-item-action {{ session('localization') == $locale ? 'active text-white' : '' }}">
                                    <a href="{{ route('localization', $locale) }}"
                                        class="list-unstyled text-decoration-none text-info ">{{ strtoupper($locale) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <form action="{{ route('contactus.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        <span class="fas fa-user"></span>
                                        <label class="mb-2" for="name">{{ __('contact.form.name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Full Name" required="required"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 md-mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        <span class="far fa-envelope-open"></span>
                                        <label class="mb-2" for="email">{{ __('contact.form.email') }}</label>
                                        <input type="email" name="email" placeholder="Email Address" required="required"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        <span class="fas fa-book"></span>
                                        <label class="mb-2" for="subject">{{ __('contact.table.subject') }}</label>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                            name="subject" placeholder="Subject" value="{{ old('subject') }}">
                                        @error('subject')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        <span class="far fa-comments"></span>
                                        <label class="mb-2" for="message">{{ __('contact.table.message') }}</label>
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 md-mb-30 mt-4">
                                    <div class="contact__two-right-form-item conbix-contact-item">
                                        <span class="far fa-envelope-open"></span>
                                        <label class="mb-2" for="photo">{{ __('contact.form.photo') }}</label>
                                        <input type="file" name="photo"
                                            class="form-control @error('photo') is-invalid @enderror"
                                            value="{{ old('photo') }}">
                                        @error('photo')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row justify-content-between">
                                    <span class="far fa-comments"></span>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="mb-2" for="captache">Enter Captache Please</label>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ route('contactus.loadCapatche') }}" alt=""
                                                class="img-fluid" width=120>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="captache"
                                                class="form-control text-black border-danger  @error('captache') is-invalid @enderror"
                                                value="">
                                            @error('captache')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row mb-0 mt-4">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('contact.form.reply') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
