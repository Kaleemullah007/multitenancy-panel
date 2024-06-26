<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Dashboard')</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

    @include('tenants.includes.style')
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>


    <div class="main-wrapper">
        {{-- Header   --}}
        @include('tenants.includes.header')

        {{-- SideNav --}}
        @include('tenants.includes.sidenav')
        <div class="page-wrapper">
        @yield('content')
        </div>

    </div>



</body>

</html>
@include('tenants.includes.script')
@yield('script')
