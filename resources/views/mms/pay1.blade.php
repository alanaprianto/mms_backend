@extends('mms.app')

@section('head')
    <title>Kadin Member Login</title>
@stop

@section('content')
<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1>Welcome</h1>
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
                        <h3>Halaman ini adalah halaman simulasi pembayaran biaya pendaftaran</h3>
                          <p></p>
                      </div>
                      <div class="form-top-right">
                        <!-- <i class="fa fa-lock"></i> -->
                      </div>
                    </div>
                    <div class="form-bottom">                      
                      {!! Form::open(['action' => ['MmsController@pay1store'], 'class' => 'm-t']) !!}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Tracking Code" name="trackingcode" required="">
                        </div>

                        <button type="submit" class="btn btn-primary block full-width m-b">Simulasikan Proses Pembayaran</button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- 
<div class="container">
    <div class="row features-block">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <img class="logo-name" src="{{ asset('resources/img/icon144-128x128-10.png') }}"/>
                </div>
                
                <h3>Welcome</h3>            
                <p>Halaman ini adalah halaman simulasi pembayaran biaya pendaftaran</p>

                {!! Form::open(['action' => ['MmsController@pay1store'], 'class' => 'm-t']) !!}
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Tracking Code" name="trackingcode" required="">
                    </div>

                    <button type="submit" class="btn btn-primary block full-width m-b">Simulasikan Proses Pembayaran</button>
                {!! Form::close() !!}
            </div>
        </div>    
    </div>
</div>     -->
@stop