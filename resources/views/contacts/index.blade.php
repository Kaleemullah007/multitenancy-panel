@extends('layouts.panel')

@section('content')
<div class="page-header my-3 mx-4">
    <div class="page-title">
        <h3>{{ __('contact.contact_heading') }}</h3>
    </div>
    {{-- <div class="page-btn">
        @haspermission('plan_create')
        <a href="{{ route('plans.create') }}" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                class="me-1">{{ __('plan.create_plan') }}</a>
            @endhaspermission
    </div> --}}
</div>
<input type="hidden" id="norecord" value="<?= __('general.table.norerord') ?>">
<div class="card">
    <div class="card-body">
        <div class="table-top">
            <div class="search-set">
                <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                        <img src="assets/img/icons/filter.svg" alt="img">
                        <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                    </a>
                </div>
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                </div>
            </div>
            <div class="wordset">
                <ul>

                    {{-- @haspermission('user_export_csv')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('contact.btn-export-csv') }}" href="{{ route('export-users', ['id' => 1, 'format' => 'csv']) }}"><img src="assets/img/icons/csv.svg" class="icon-adjustment" alt="img"></a></li>
                    @endhaspermission


                    @haspermission('user_export_excel')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('contact.btn-export-xlsx') }}" href="{{ route('export-users', ['id' => 1, 'format' => 'xlxs']) }}"><img src="assets/img/icons/excel2.svg" class="icon-adjustment" alt="img"></a></li>
                    @endhaspermission
                    @haspermission('user_export_pdf')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('contact.btn-export-pdf') }}" href="{{ route('contacts.pdf') }}" download><img src="assets/img/icons/pdf.svg" class="icon-adjustment" alt="img"></a></li>
                    @endhaspermission
                    @haspermission('user_import_csv')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('contact.btn-import-cvs') }}" href="{{ route('file-import') }}"><img src="assets/img/icons/import.svg" class="icon-adjustment" alt="img"></a></li>
                    @endhaspermission --}}


                </ul>
            </div>
        </div>
        <div class="card mb-0" id="filter_inputs">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Product</option>
                                        <option>Macbook pro</option>
                                        <option>Orange</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Category</option>
                                        <option>Computers</option>
                                        <option>Fruits</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Sub Category</option>
                                        <option>Computer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Brand</option>
                                        <option>N/D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg col-sm-6 col-12 ">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Price</option>
                                        <option>150.00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table datanew dataTable no-footer">
                @if (session()->has('message'))
                <div class="alert text-center alert-{{ session('error') }}">
                    {{ session('message') }}
                </div>
                @endif
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
                    @php
                    if (request('page') > 1) {
                    $counter = (request('page') - 1) * config('app.per_page') + 1;
                    } else {
                    $counter = 1;
                    }

                    @endphp


                    @if ($contacts->count() > 0)
                    @foreach ($contacts as $key => $contact)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        <td> <a href="<?php echo asset('/storage/app/public/' . $contact->file); ?>" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo asset('/storage/app/public/' . $contact->file); ?>" class="w-25 img-fluid  img-thumbnail"></a>
                        </td>
                        <td>{{ $contact->created_at?->diffForHumans() }}</td>
                        <td>
                            @haspermission('contact_reply')
                            <a href="{{ route('contacts.edit', [$contact->id]) }}?page={{ $contacts->currentPage() }}" class="btn btn-danger">
                                {{ str(__('contact.table.reply'))->plural($contact->replies_count) }}
                                ({{ $contact->replies_count }})
                                @endhaspermission
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    {{-- <tr>
                        <td colspan="6" class="text-center">{{ __('general.no-record') }}</td>
                    </tr> --}}
                    @endif
                </tbody>
            </table>
        </div>

        <div class="container">
            {{ $contacts->onEachSide(5)->links() }}
        </div>
    </div>
</div>
@endsection
