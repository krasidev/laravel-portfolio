<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Custom Styles -->
    <style>
        #auth form {
            max-width: 100%;
            width: 360px;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div id="auth">
        <main>
            <div class="container-fluid">
                <div class="vh-100 d-flex flex-wrap justify-content-center align-items-center">
                    @yield('content')
                </div>
            </div>

            @yield('scripts')
        </main>
    </div>
</body>
</html>
