@extends('layouts.panel')


@section('content')
<div class="page-header">
    <div class="page-title">
        <h4>Product List</h4>
        <h6>Manage your products</h6>
    </div>
    <div class="page-btn">
        <a href="addproduct.html" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                class="me-1">Add New Product</a>
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
                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                            alt="img"></a>
                </div>
            </div>
            <div class="wordset">
                <ul>

                    @haspermission('tenant_create')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.create_user') }}" href="{{ route('tenants.create') }}" ><img src="assets/img/icons/users1.svg" class="icon-adjustment"  alt="img"></a></li>
                @endhaspermission
                @haspermission('tenant_view')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.users') }}" href="{{ route('tenants.index') }}" ><img src="assets/img/icons/listing.svg" class="icon-adjustment" alt="img"></a></li>
                @endhaspermission
            
            
            
            
                @haspermission('user_export_csv')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.btn-export-csv') }}" href="{{ route('export-users', ['id' => 1, 'format' => 'csv']) }}"><img src="assets/img/icons/csv.svg" class="icon-adjustment" alt="img"></a></li>
                @endhaspermission
            
            
                @haspermission('user_export_excel')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.btn-export-xlsx') }}" href="{{ route('export-users', ['id' => 1, 'format' => 'xlxs']) }}"><img src="assets/img/icons/excel2.svg" class="icon-adjustment" alt="img"></a></li>
                @endhaspermission
                @haspermission('user_export_pdf')
                <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.btn-export-pdf') }}" href="{{ route('tenants.pdf') }}" download ><img src="assets/img/icons/pdf.svg" class="icon-adjustment" alt="img"></a></li>
            @endhaspermission
                @haspermission('user_import_csv')
                    <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('tenant.btn-import-cvs') }}" href="{{ route('file-import') }}" ><img src="assets/img/icons/import.svg" class="icon-adjustment" alt="img"></a></li>
                @endhaspermission

                    
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
                                    <a class="btn btn-filters ms-auto"><img
                                            src="assets/img/icons/search-whites.svg" alt="img"></a>
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
                <th scope="col">{{ __('tenant.table.#') }}</th>
                <th scope="col">{{ __('tenant.table.avatar') }}</th>
                <th scope="col">{{ __('tenant.table.name') }}</th>
                <th scope="col">{{ __('tenant.table.email') }}</th>
                <th scope="col">{{ __('tenant.table.domains') }}</th>
                <th scope="col">{{ __('tenant.table.date') }}</th>
                <th scope="col">{{ __('tenant.table.action') }}</th>
            </tr>
        </thead>
        <tbody >
            @php
                if (request('page') > 1) {
                    $counter = (request('page') - 1) * config('app.per_page') + 1;
                } else {
                    $counter = 1;
                }

            @endphp


            @if ($tenants->count() > 0)
                @foreach ($tenants as $key => $tenant)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td><img src="<?php echo asset('/storage/app/public/' . $tenant->file); ?>" class="img-fluid w-50 rounded-pill"
                                style="height: 50px !important; border-radius: 50%">
                        </td>
                        <td>{{ $tenant->name }}</td>
                        <td>{{ $tenant->email }}</td>
                        <td>
                            @foreach ($tenant->domains as $domain)
                                <span class="badge bg-danger"><button class="mybutton" id="{{ $domain->id }}href"
                                        rel="{{ $domain->domain }}{{ $loop->last ? '' : ',' }}">{{ $domain->domain }}
                                        {{ $loop->last ? '' : ',' }}</button></span>
                            @endforeach

                        </td>

                        <td>{{ $tenant->user?->start_date }},{{ $tenant->user?->end_date }}</td>
                        <td> 
                            <a 
                                href="{{ route('tenants.edit', $tenant->id) }}?page={{ $tenants->currentPage() }}" title="{{ __('tenant.edit') }}" data-bs-toggle="tooltip" data-bs-placement="top"><img
                                src="assets/img/icons/edit.svg"  class="icon-adjustment" alt="img"></a>
                            <a id="renew{{$tenant->id}}"
                                href="{{ route('tenants.renew', $tenant->id) }}?page={{ $tenants->currentPage() }}"  class=""  ></a><img
                                src="assets/img/icons/renew.svg" alt="img" style="cursor: pointer;" class="icon-adjustment _renew cursor" data-bs-placement="top" data-bs-toggle="tooltip" title="{{ __('tenant.renew') }}" data-id="{{$tenant->id}}" >
                                
                            @include('tenant.delete')
                        
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
        {{ $tenants->onEachSide(5)->links() }}
    </div>
    </div>
</div>

@endsection
