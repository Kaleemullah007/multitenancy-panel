@extends('layouts.app')
@section('content')
    @haspermission('emailtemplates_create')
        <a class="btn btn-lg bg-primary" href="{{ route('emailtemplates.create') }}">{{ __('emailtemplate.create') }}</a>
    @endhaspermission
    <table class="table">
        @if (session()->has('message'))
            <div class="alert text-center alert-{{ session('error') }}">
                {{ session('message') }}
            </div>
        @endif
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('emailtemplate.table.subject') }}</th>
                <th scope="col">{{ __('emailtemplate.table.title') }}</th>
                <th scope="col">{{ __('emailtemplate.table.body') }}</th>
                <th scope="col">{{ __('emailtemplate.table.template_type') }}</th>
                <th scope="col">{{ __('emailtemplate.table.status') }}</th>
                <th scope="col">{{ __('emailtemplate.table.action') }}</th>
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
            @if ($emailtemplates->count() > 0)
                @foreach ($emailtemplates as $key => $emailtemplate)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $emailtemplate->subject }}</td>
                        <td>{{ $emailtemplate->title }}</td>
                        <td>{{ $emailtemplate->body }}</td>
                        <td>{{ $emailtemplate->template_type->getlabelText() }}</td>
                        <td>{{ $emailtemplate->status }}</td>

                        <td>
                            @haspermission('emailtemplates_edit')
                                <a
                                    href="{{ route('emailtemplates.edit', $emailtemplate->id) }}?page={{ $emailtemplates->currentPage() }}">{{ __('emailtemplate.edit') }}</a>
                            @endhaspermission
                            @include('tenants.emailtemplates.delete')

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">{{ __('general.no-record') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="container">
        {{ $emailtemplates->onEachSide(5)->links() }}
    </div>
@endsection
