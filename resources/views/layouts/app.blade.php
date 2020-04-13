<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="MaximWeb" name="author"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
        @stack('styles')
        <style>
            .table td, .table th {
                vertical-align: middle;
            }
        </style>
    </head>
    <body>

        @include('includes.alerts')

        <div id="wrapper">
            <div class="navbar-custom">
                @include('includes.topnav-menu-right')
                @include('includes.topnav-menu-logo-box')
                @include('includes.topnav-menu-left')
            </div>
            @include('includes.left-side-menu')
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    @yield('content')
                </div> <!-- content -->
                @include('includes.footer')
            </div>
        </div>
{{--        @include('includes.right-bar')--}}
        <div class="rightbar-overlay"></div>
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>


