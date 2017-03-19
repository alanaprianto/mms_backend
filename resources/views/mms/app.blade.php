<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/form-elements.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/style.css') }}" rel="stylesheet">

    @yield('head')
</head>

<body>
    @yield('body')

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="footer-border"></div>
                <p>© 2016 KADIN INDONESIA. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Mainly scripts -->
<script>
    var img1 = "{{ asset('img/backgrounds/1.jpg') }}";
    var img2 = "{{ asset('img/backgrounds/2.jpg') }}";
    var img3 = "{{ asset('img/backgrounds/3.jpg') }}";
</script>
<!-- <script src="{{ asset('js/jquery-2.1.1.js') }}"></script> -->
<script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/login/jquery.backstretch.min.js') }}"></script>
<script src="{{ asset('js/login/scripts.js') }}"></script>
</body>
</html>
