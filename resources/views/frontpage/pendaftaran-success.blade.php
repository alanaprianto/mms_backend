@extends('frontpage.appregister')

@section('memberactive')
  <?php echo 'active';?>
@stop

@section('head')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kadin Register Member</title>

<!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
@stop

@section('content')
<div class="container">
    <div class="row features-block">
        <br/>
        <div class="middle-box text-center loginscreen   animated fadeInDown">
            <div>
                <div>
                    <img class="logo-name" src="{{ asset('img/icon144-128x128-10.png') }}"/>
                </div>
                <h5>Your Form has been Succesfully Saved!</h5>
                <p>Check your E-Mail for further information.</p>
            </div>
        </div>
        <br/>
    </div>    
</div>
@stop

@push('scripts')
<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endpush
