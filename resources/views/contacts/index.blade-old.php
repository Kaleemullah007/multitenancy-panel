@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('contact.contact_heading') }}

                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @php
                            if (request('page') > 1) {
                                $counter = (request('page') - 1) * config('app.per_page') + 1;
                            } else {
                                $counter = 1;
                            }

                        @endphp

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('contact.table.#') }}</th>
                                    <th scope="col">{{ __('contact.table.name') }}</th>
                                    <th scope="col">{{ __('contact.table.email') }}</th>
                                    <th scope="col">{{ __('contact.table.subject') }}</th>
                                    <th scope="col">{{ __('contact.table.message') }}</th>
                                    <th scope="col">{{ __('contact.table.photo') }}</th>
                                    <th scope="col">{{ __('contact.table.date') }}</th>
                                    <th scope="col">{{ __('contact.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($contacts->count() > 0)
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <th scope="row">{{ $counter++ }}</th>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td> <a href="<?php echo asset('/storage/app/public/' . $contact->file); ?>" target="_blank" rel="noopener noreferrer">
                                                    <img src="<?php echo asset('/storage/app/public/' . $contact->file); ?>"
                                                        class="w-25 img-fluid  img-thumbnail"></a>
                                            </td>
                                            <td>{{ $contact->created_at?->diffForHumans() }}</td>
                                            <td> 
                                                @haspermission('contact_reply')
                                                    <a href="{{ route('contacts.edit', [$contact->id]) }}?page={{ $contacts->currentPage() }}"
                                                        class="btn btn-danger">
                                                        {{ str(__('contact.table.reply'))->plural($contact->replies_count) }}
                                                        ({{ $contact->replies_count }})
                                                    @endhaspermission  
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('general.no-record') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="container">
                            {{ $contacts->onEachSide(5)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
