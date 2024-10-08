@extends('layouts.panel')

@section('content')
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{ __('compaign.campaigns') }}</h3>
        </div>
        <div class="page-btn">
            @haspermission('campaigns_create')
                <a href="{{ route('campaigns.create') }}" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                        class="me-1">{{ __('compaign.create_compaign') }}</a>
            @endhaspermission
        </div>
    </div>

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

                        {{-- @haspermission('campaigns_create')
                        <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('compaign.create_campaign') }}" href="{{ route('campaigns.create') }}" ><img src="assets/img/icons/users1.svg" class="icon-adjustment"  alt="img"></a></li>
                    @endhaspermission --}}
                        {{-- @haspermission('campaigns_view')
                            <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('compaign.campaigns') }}"
                                    href="{{ route('campaigns.index') }}"><img src="assets/img/icons/listing.svg"
                                        class="icon-adjustment" alt="img"></a></li>
                        @endhaspermission

                        @haspermission('campaign_export_csv')
                            <li><a data-bs  -toggle="tooltip" data-bs-placement="top" title="{{ __('compaign.btn-export-csv') }}"
                                    href="{{ route('export-campaigns', ['id' => 1, 'format' => 'csv']) }}"><img
                                        src="assets/img/icons/csv.svg" class="icon-adjustment" alt="img"></a></li>
                        @endhaspermission
                        @haspermission('campaign_export_excel')
                            <li><a data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ __('compaign.btn-export-xlsx') }}"
                                    href="{{ route('export-campaigns', ['id' => 1, 'format' => 'xlxs']) }}"><img
                                        src="assets/img/icons/excel2.svg" class="icon-adjustment" alt="img"></a></li>
                        @endhaspermission
                        @haspermission('campaigns_export_pdf')
                            <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('compaign.btn-export-pdf') }}"
                                    href="{{ route('tenants.pdf') }}" download><img src="assets/img/icons/pdf.svg"
                                        class="icon-adjustment" alt="img"></a></li>
                        @endhaspermission
                        @haspermission('campaigns_import_csv')
                            <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('compaign.btn-import-cvs') }}"
                                    href="{{ route('file-import') }}"><img src="assets/img/icons/import.svg"
                                        class="icon-adjustment" alt="img"></a></li>
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
                                            <option>all</option>
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
                                        <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                                alt="img"></a>
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
                            <th scope="col">#</th>
                            <th scope="col">{{ __('compaign.table.name') }}</th>
                            <th scope="col">{{ __('compaign.table.user_type') }}</th>
                            <th scope="col">{{ __('compaign.table.template_type') }}</th>
                            <th scope="col">{{ __('compaign.table.published_at') }}</th>
                            <th scope="col">{{ __('compaign.table.type') }}</th>
                            <th scope="col">{{ __('compaign.table.status') }}</th>
                            <th scope="col">{{ __('compaign.table.action') }}</th>
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
                        @if ($campaigns->count() > 0)
                            @foreach ($campaigns as $key => $campaign)
                                <tr>
                                    <td scope="row">{{ $counter++ }}</td>
                                    <td>{{ $campaign->name }}</td>
                                    <td>{{ $campaign->user_type }}</td>
                                    <td>{{ $campaign->email_template_id }}</td>
                                    <td>{{ $campaign->published_at }}</td>
                                    <td>{{ $campaign->type->getlabelText() }}</td>
                                    <td>{{ $campaign->status }}</td>

                                    <td>
                                        @haspermission('campaigns_edit')
                                            <a
                                                href="{{ route('campaigns.edit', $campaign->id) }}?page={{ $campaigns->currentPage() }}"
                                                 title="{{ __('compaign.edit') }}" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <img src="assets/img/icons/edit.svg" class="icon-adjustment" alt="img">
                                            </a>
                                        @endhaspermission
                                        @include('tenants.compaigns.delete')

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- <tr>
                        <td colspan="8" class="text-center">{{ __('general.no-record') }}</td>
                    </tr> --}}
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="container">

                {{ $campaigns->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
@endsection
