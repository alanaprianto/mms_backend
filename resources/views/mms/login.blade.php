@extends('mms.app')

@section('head')
    <title>Kadin MMS Login</title>
@stop

@section('content')
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

<!--
    <div class="middle-box text-center loginscreen   animated fadeInDown">
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
-->
@stop
