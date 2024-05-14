<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <style>
        body {
            padding: 0;
            margin 0;
        }

        div.page-layout {
            height: 295.5mm;
            width: 209mm;
        }
    </style>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body style="margin:0; padding:0;">
    <div style="height: 28px;">&nbsp;</div>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}


                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="list-group list-group-horizontal">
                                    @foreach (config('localizations.locales') as $locale)
                                        <li
                                            class="list-group-item list-group-item list-group-item-action {{ session('localization') == $locale ? 'active text-white' : '' }}">
                                            <a href="{{ route('localization', $locale) }}"
                                                class="list-unstyled text-decoration-none text-info ">{{ strtoupper($locale) }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="dropdown-menu
                                                dropdown-menu-end"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit', [auth()->id()]) }}">
                                        Edit Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <ul class="inline-block list-group list-group-horizontal">
            {{-- dd(app('auth')->user()->getAllPermissions()->toArray(),
        app('auth')->user()->can('permissions.read'), app('auth')->user()->hasPermissionTo('permissions.read')); --}}
            @haspermission('user_view')
                <li class="nav-item list-unstyled"><a href="{{ route('users.index') }}" class="btn btn-lg bg-primary">
                        {{ __('permission.users') }}</a></li>
            @endhaspermission
            @haspermission('permissions_view')
                <li class="nav-item list-unstyled"><a href="{{ route('permissions.index') }}"
                        class="btn btn-lg bg-primary">{{ __('permission.permissions') }}</a></li>
            @endhaspermission
            @haspermission('roles_view')
                <li class="nav-item list-unstyled"><a href="{{ route('roles.index') }}"
                        class="btn btn-lg bg-primary">{{ __('permission.roles') }}</a>
                </li>
            @endhaspermission



            @haspermission('tenant_view')
                <li class="list-group-item text-decoration-none">
                    <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">{{ __('tenant.tenants') }}</a>
                </li>
            @endhaspermission

            @haspermission('plan_view')
                <li class="list-group-item text-decoration-none">
                    <a href="{{ route('plans.index') }}" class="btn btn-lg bg-primary">{{ __('plan.plans') }}</a>
                </li>
            @endhaspermission
            @haspermission('contact_view')
                <li class="list-group-item text-decoration-none">
                    <a href="{{ route('contacts.index') }}" class="btn btn-lg bg-primary">{{ __('contact.contacts') }}</a>
                </li>
            @endhaspermission

            {{-- @haspermission('tenant_view')
                <li class="list-group-item text-decoration-none">
                    <a href="{{ route('roles.index') }} " class="btn btn-lg bg-primary">{{ __('permission.roles') }}</a>
                </li>
            @endhaspermission --}}


        </ul>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script>
    setTimeout(() => {
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(".mybutton").click(function(event) {
            // event.preventDefault();
            var link = $("#" + this.id).attr('rel');

            url = link + ":8000/login";
            window.open("http://" +
                url, '_blank').focus();;
        });

    }, 1000);
</script>

</html>
