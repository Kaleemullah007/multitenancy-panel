<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriculation Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .result-card {
            background-color: #fff;
            padding
        }
    </style>
</head>

<body>
    <table class="table">
        @if (session()->has('message'))
            <div class="alert text-center alert-{{ session('error') }}">
                {{ session('message') }}
            </div>
        @endif
        <thead>
            <tr>
                <th scope="col">{{ __('tenant.table.#') }}</th>
                <th scope="col">{{ __('tenant.table.name') }}</th>
                <th scope="col">{{ __('tenant.table.email') }}</th>
                <th scope="col">{{ __('tenant.table.date') }}</th>

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
                        <td>{{ $tenant->name }}</td>
                        <td>{{ $tenant->email }}</td>


                        <td>{{ $tenant->created_at->diffForHumans() }}</td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">{{ __('general.no-record') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

</body>

</html>
