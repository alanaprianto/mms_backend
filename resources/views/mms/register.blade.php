<html><!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho --><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kadin Register Member</title>

    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <img class="logo-name" src="{{ asset('resources/img/icon144-128x128-10.png') }}"/>

            </div>
            <h3>Create your Kadin Member Account</h3>
            <p>Create member account for {{ $compclass }} {{ $compname }}.</p>       

            @include('errors.error_list')
                 
            {!! Form::open(['action' => ['MmsController@createuser'], 'class' => 'm-t']) !!}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tracking Code" name="trackingcode" value="{{ $code }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $name }}">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $email }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" placeholder="Territory" name="territory" value="{{ $territory }}">
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><i></i> Agree the terms and policy </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
                
            {!! Form::close() !!}
            <p class="m-t"> <small>© 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('resources/assets/js/jquery-2.1.1.js') }}"></script>
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



<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->

</body></html>