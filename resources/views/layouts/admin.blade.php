<!doctype html>
<html lang="en" data-bs-theme="light1">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>

    <!--Styles-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @yield('css')

</head>
<body>

<div class="container-fluid">

@include('layouts.sections.admin.sidebar')


<!--start main content-->

<main class="main-content">

@yield('content')

</main>
<!--end main content-->
</div>


<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<!--BS Scripts-->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
    });
</script>
@yield('js')
</body>
</html>
