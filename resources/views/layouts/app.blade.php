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


    {{-- ====== non generic auth ========= --}}
        <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.jpg">

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/jquery-3.6.0.min.js"></script>

    <script src="/assets/js/feather.min.js"></script>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/js/script.js"></script>

    {{-- ====== non generic auth ========= --}}




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
    <style>
        .log-in {
            background-size: cover;
            min-height: 100vh;
        }

        .anchor-css,
        .anchor-css:hover {
            color: rgb(29, 29, 29);
            text-decoration: none;
        }

        .sign-in-css {
            border-radius: 10px;
            width: 360px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .log-in-logo {
            height: 50px;
            width: 140px;
            border-radius: 5px;
        }
    </style>
</head>

<body style="margin:0; padding:0;">
    {{-- <div style="height: 28px;">&nbsp;</div> --}}
    <div id="app">

        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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
                    Left Side Of Navbar
                    <ul class="navbar-nav me-auto">

                    </ul>

                    Right Side Of Navbar
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
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
        </nav> --}}


        <ul class="inline-block list-group list-group-horizontal">
            {{-- dd(app('auth')->user()->getAllPermissions()->toArray(),
        app('auth')->user()->can('permissions.read'), app('auth')->user()->hasPermissionTo('permissions.read')); --}}
            @haspermission('user_view')
                <li class="nav-item list-unstyled"><a href="{{ route('users.index') }}" class="btn btn-lg bg-primary">
                        {{ __('permission.users') }}</a></li>
            @endhaspermission
            @haspermission('permissions_view')
                <li class="nav-item list-unstyled   ms-2"><a href="{{ route('permissions.index') }}"
                        class="btn btn-lg bg-primary">{{ __('permission.permissions') }}</a></li>
            @endhaspermission
            @haspermission('roles_view')
                <li class="nav-item list-unstyled ms-2"><a href="{{ route('roles.index') }}"
                        class="btn btn-lg bg-primary">{{ __('permission.roles') }}</a>
                </li>
            @endhaspermission




            @haspermission('placeholders_view')
                <li class="nav-item list-unstyled ms-2"><a href="{{ route('placeholders.index') }}"
                        class="btn btn-lg bg-primary">{{ __('placeholder.placeholders') }}</a>
                </li>
            @endhaspermission

            @haspermission('emailtemplates_view')
                <li class="nav-item list-unstyled ms-2"><a href="{{ route('emailtemplates.index') }}"
                        class="btn btn-lg bg-primary">{{ __('emailtemplate.emailtemplates') }}</a>
                </li>
            @endhaspermission

            @haspermission('campaigns_view')
                <li class="nav-item list-unstyled ms-2"><a href="{{ route('campaigns.index') }}"
                        class="btn btn-lg bg-primary">{{ __('compaign.campaigns') }}</a>
                </li>
            @endhaspermission


            @haspermission('tenant_view')
                <li class="list-group-item text-decoration-none ms-2">
                    <a href="{{ route('tenants.index') }}" class="btn btn-lg bg-primary">{{ __('tenant.tenants') }}</a>
                </li>
            @endhaspermission

            @haspermission('plan_view')
                <li class="list-group-item text-decoration-none ms-2">
                    <a href="{{ route('plans.index') }}" class="btn btn-lg bg-primary">{{ __('plan.plans') }}</a>
                </li>
            @endhaspermission
            @haspermission('contact_view')
                <li class="list-group-item text-decoration-none ms-2">
                    <a href="{{ route('contacts.index') }}" class="btn btn-lg bg-primary">{{ __('contact.contacts') }}</a>
                </li>
            @endhaspermission

            {{-- @haspermission('tenant_view')
                <li class="list-group-item text-decoration-none ms-2">
                    <a href="{{ route('roles.index') }} " class="btn btn-lg bg-primary">{{ __('permission.roles') }}</a>
                </li>
            @endhaspermission --}}


        </ul>
        <main class="">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script>
    setTimeout(() => {
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    }, 1000);
    let viewPassword = document.querySelector("#viewPassword");
    viewPassword.addEventListener("click", ()=>{
        let password = document.querySelector("#password");
    if(password.getAttribute('type') == 'password'){
        password.setAttribute('type','text');
    }else{
        password.setAttribute('type','password');
    }

    });
   

    // function Copy(id) {
    //     setTimeout(function() {
    //         $('#copied_tip').remove();
    //     }, 1500);

    //     cc = $("#" + id).attr('rel');

    //     $("#" + cc).append("<div class='tip' id='copied_tip'>Copied!</div>");
    //     text = $("#" + cc).attr('rel');

    //     alert(text)


    //     var input = document.createElement('input');
    //     input.setAttribute('value', text);
    //     document.body.appendChild(input);
    //     input.select();
    //     var result = document.execCommand('copy');
    //     document.body.removeChild(input)

    //     return result;
    // }
    function copyToClipboard(elementId) {

        // Create a "hidden" input
        elementId = $("#" + elementId).attr('rel');
        var aux = document.createElement("input");

        text = $("#" + elementId).attr('rel');
        // Assign it the value of the specified element
        aux.setAttribute("value", text.trim());

        // Append it to the body
        document.body.appendChild(aux);

        // Highlight its content
        aux.select();

        // Copy the highlighted text
        document.execCommand("copy");

        // Remove it from the body
        document.body.removeChild(aux);

        let textarea = document.getElementById("body");
        textarea.focus();
        var start = '{';
        var end = '}';
        textarea.value += start + document.getElementById(elementId).innerHTML.trim() + end;
    }
</script>

</html>
