<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <title>@yield('title', 'Login Page')</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">


        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

        @yield('css')

    </head>

    <body class="mt-5">

        @yield('content')

        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
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



