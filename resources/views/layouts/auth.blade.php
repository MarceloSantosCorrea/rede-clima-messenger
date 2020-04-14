<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <title>{{ config('app.name') }} - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
        <meta content="Coderthemes" name="author"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css', true) }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/icons.min.css', true) }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/app.min.css', true) }}" rel="stylesheet" type="text/css"/>
    </head>

    <body class="authentication-bg authentication-bg-pattern">
        <div class="account-pages mt-5 mb-5">
            @yield('content')
        </div>
        <footer class="footer footer-alt">
            2020 - {{ date('Y') }} &copy; Desenvolvido por
            <a href="https://maximweb.com.br" target="_blank" class="text-white-50">Maxim Web</a>
        </footer>
        <script src="{{ asset('assets/js/vendor.min.js', true) }}"></script>
        <script src="{{ asset('assets/js/app.min.js', true) }}"></script>
    </body>
</html>