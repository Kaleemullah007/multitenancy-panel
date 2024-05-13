@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ route('contact-message') }}" class="btn btn-primary">

                            {{ __('contact.contact_heading') }}
                        </a> </div>

                    <div class="card-body">
                        <div class="getIn__touch-left-form">
                            <form action="{{ route('contacts.update', $contact->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-30 mt-4">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <span class="fas fa-user"></span>
                                            <label for="name">{{ __('contact.form.name') }}</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Full Name" required="required"
                                                value="{{ old('name', $contact->name) }}" readonly>
                                            @error('name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 md-mb-30 mt-4">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <span class="far fa-envelope-open"></span>
                                            <label for="email">{{ __('contact.form.email') }}</label>
                                            <input type="email" name="email" placeholder="Email Address"
                                                required="required"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $contact->email) }}" readonly>
                                            @error('email')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-30 mt-4">
                                        <div class="contact__two-right-form-item conbix-contact-item" readonly>
                                            <span class="fas fa-book"></span>
                                            <label for="subject">{{ __('contact.table.subject') }}</label>
                                            <input type="text"
                                                class="form-control @error('subject') is-invalid @enderror" name="subject"
                                                placeholder="Subject" value="{{ old('subject', $contact->subject) }}">
                                            @error('subject')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-30 mt-4">
                                        <div class="contact__two-right-form-item conbix-contact-item">
                                            <span class="far fa-comments"></span>
                                            <label for="message">{{ __('contact.table.message') }}</label>
                                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message">{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="error text-danger">{{ $message }}</div>
                                            @enderror
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

                            @haspermission('contact_view_reply')
                                @include('contacts.replies')
                            @endhaspermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
