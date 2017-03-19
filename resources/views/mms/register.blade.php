@extends('mms.app')

@section('head')
    <title>Kadin Register Member</title>
@endsection

@section('body')
    <!-- Top content -->
    <div class="top-content">
        <div class="inner-bg" style="padding-bottom: 50px">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <div>
                            <img class="logo-name" src="{{ asset('img/icon144-128x128-10.png') }}"/>
                        </div>

                        <h3>Create your Kadin Member Account</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-box" style="margin-top:50px;">
                            <div class="form-top">
                                <div class="form-top-left" style="width:100%;">
                                    <p>Create member account for {{ $compclass }} {{ $compname }}.</p>
                                </div>
                            </div>
                            <div class="form-bottom">
                                @include('errors.error_list')

                                {!! Form::open(['action' => ['PendaftaranController@store_code'], 'class' => 'm-t']) !!}
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Tracking Code" name="trackingcode" value="{{ $code }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $email }}" readonly>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection