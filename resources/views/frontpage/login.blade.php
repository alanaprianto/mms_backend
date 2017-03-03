<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/form-elements.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/style.css') }}" rel="stylesheet">

    <title>Kadin MMS Login</title>
</head>

<body>

<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1>Welcome to Kadin Member Login</h1>
                    <div class="description">
                        <p>
                            INDONESIAN CHAMBER OF COMMERCE & INDUSTRY
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Login For Member</h3>
                                <p>Enter username and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            {!! Form::open(['action' => ['LoginController@login'], 'class' => 'login-form']) !!}
                            <div class="form-group">
                                <label class="sr-only" for="form-username">Username</label>
                                <input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                            </div>
                            <button class="btn btn-warning" type="submit">
                                <i class="fa fa-lock"></i>
                                <span class="bold">Login</span>
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<!-- <script src="{{ asset('js/jquery-2.1.1.js') }}"></script> -->
<script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/login/jquery.backstretch.min.js') }}"></script>
<script src="{{ asset('js/login/scripts.js') }}"></script>

</body>
</html>
