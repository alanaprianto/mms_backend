<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/login/form-elements.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/login/style.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body>

    @yield('content')

    <!-- Mainly scripts -->
    <!-- <script src="{{ asset('resources/assets/js/jquery-2.1.1.js') }}"></script> -->
    <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/login/jquery.backstretch.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/login/scripts.js') }}"></script>
    @stack('scripts')

</body>
</html>
