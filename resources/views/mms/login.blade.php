@extends('mms.app')

@section('head')
    <title>Kadin Member Login</title>
@stop

@section('content')
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
@stop