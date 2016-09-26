<html><!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho --><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kadin Member Login</title>

    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    
    <link href="{{ asset('resources/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img class="logo-name" src="{{ asset('resources/img/icon144-128x128-10.png') }}"/>

            </div>
            <h3>Welcome to Kadin Member Login</h3>            
            <p>Login in. To see it in action.</p>     
            
            @include('errors.error_list')

            {!! Form::open(['action' => ['LoginController@login'], 'class' => 'm-t']) !!}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>                
            {!! Form::close() !!}
            <p class="m-t"> <small>© 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('resources/assets/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>




<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->

</body></html>