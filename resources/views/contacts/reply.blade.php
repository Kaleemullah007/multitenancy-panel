@extends('layouts.panel')
@section('content')

    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('contact.reply') }}</h3>
        </div>
        <div class="page-btn">
            {{-- @haspermission('contacts_view') --}}
            <a href="{{ route('contact-message') }}" class="btn btn-added">{{ __('contact.contact_heading') }}</a>
            {{-- @endhaspermission --}}
        </div>
    </div>
    <div class="card">
        <div class="card-body">

                            <form action="{{ route('contacts.update', $contact->id) }}" method="post">
                                @csrf
                                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12 mb-3">
                        <div class="contact__two-right-form-item conbix-contact-item">
                            {{-- <span class="fas fa-user"></span> --}}
                            <label class="mb-2" for="name">{{ __('contact.form.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Full Name" required="required" value="{{ old('name', $contact->name) }}"
                                readonly>
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12 mb-3">
                        <div class="contact__two-right-form-item conbix-contact-item">
                            {{-- <span class="far fa-envelope-open"></span> --}}
                            <label class="mb-2" for="email">{{ __('contact.form.email') }}</label>
                            <input type="email" name="email" placeholder="Email Address" required="required"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $contact->email) }}" readonly>
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12 mb-3">
                        <div class="contact__two-right-form-item conbix-contact-item" readonly>
                            {{-- <span class="fas fa-book"></span> --}}
                            <label class="mb-2" for="subject">{{ __('contact.table.subject') }}</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject"
                                placeholder="Subject" value="{{ old('subject', $contact->subject) }}">
                            @error('subject')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{--  description --}}
                    <div class="col-lg-6 col-sm-6 col-12 mb-3">
                        <div class="contact__two-right-form-item conbix-contact-item">
                            {{-- <span class="far fa-comments"></span> --}}
                            <label class="mb-2" for="message">{{ __('contact.table.message') }}</label>
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0 text-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('contact.form.reply') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @haspermission('contact_view_reply')
                @include('contacts.replies')
            @endhaspermission
        </div>
    </div>
@endsection
