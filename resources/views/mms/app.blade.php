<html><!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho --><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    

    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">            
    @yield('head')
</head>

<body class="gray-bg">

    @yield('content')    

    <!-- Mainly scripts -->
    <!-- <script src="{{ asset('resources/assets/js/jquery-2.1.1.js') }}"></script> -->
    <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('resources/assets/js/plugins/iCheck/icheck.min.js') }}"></script>
    
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    @stack('scripts')

</body>
</html>