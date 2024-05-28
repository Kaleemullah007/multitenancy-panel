@extends('layouts.panel')

@section('content')
    @haspermission('tenant_create')
        <a class="btn btn-submit me-2" href="{{ route('tenants.create') }}" >{{ __('tenant.create_user') }}</a>
    @endhaspermission
    @haspermission('tenant_view')
        <a class="btn btn-submit me-2" href="{{ route('tenants.index') }}" >{{ __('tenant.users') }}</a>
    @endhaspermission


    @haspermission('user_import_csv')
        <a class="btn btn-submit me-2" href="{{ route('file-import') }}" >{{ __('tenant.btn-import-cvs') }}</a>
    @endhaspermission

    @haspermission('user_export_csv')
        <a class="btn btn-submit me-2" href="{{ route('export-users', ['id' => 1, 'format' => 'csv']) }}"
            >{{ __('tenant.btn-export-csv') }}</a>
    @endhaspermission


    @haspermission('user_export_excel')
        <a class="btn btn-submit me-2" href="{{ route('export-users', ['id' => 1, 'format' => 'xlxs']) }}"
            >{{ __('tenant.btn-export-xlsx') }}</a>
    @endhaspermission


    @haspermission('user_export_pdf')
        <a class="btn btn-submit me-2" href="{{ route('tenants.pdf') }}" download >{{ __('tenant.btn-export-pdf') }}</a>
    @endhaspermission







    <div class="card">
        <div class="card-body">
        
        





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
        <tbody>
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
                        <td> <a
                                href="{{ route('tenants.edit', $tenant->id) }}?page={{ $tenants->currentPage() }}">{{ __('tenant.edit') }}</a><br>
                            <a
                                href="{{ route('tenants.renew', $tenant->id) }}?page={{ $tenants->currentPage() }}">{{ __('tenant.renew') }}</a><br>
                            @include('tenant.delete')
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">{{ __('general.no-record') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
        </div>
    </div>
    <div class="container">
        {{ $tenants->onEachSide(5)->links() }}
    </div>
@endsection
