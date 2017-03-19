<!DOCTYPE html>
<html lang="en">

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Add Your favicon here -->
    <!--<link rel="icon" href="img/favicon.ico">-->

    <title>KEANGGOTAAN KADIN</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">    

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/register/style.css') }}" rel="stylesheet">    
</head>
<body id="page-top">

  <section class="features">
    <div class="container">
		<div class="row features-block">
            <div class="col-lg-12 features-text wow fadeInLeft">
                <!-- <strong>REGISTER MEMBER KEANGGOTAAN KADIN INDONESIA</strong><br/> -->
                <strong>REGISTER ANGGOTA BIASA KADIN INDONESIA</strong><br/>
                <small>Silahkan isi data pada form dibawah ini !</small><br/><br/>
                @include('errors.error_list')

                {!! Form::open(['action' => ['PendaftaranController@storeall', 'true'], 'id' => 'wadah']) !!}
                    <input type="hidden" name="alb" value="false">
                {!! Form::close() !!}
            </div>
		</div>
	</div>
  </section>
  <br/><br/>
<script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    {{ $alb = false }}
    <script type="text/javascript">
      var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
      var init = "{{ session()->has('result') }}";
      if (init) {
        var answers = JSON.parse("{{ session('result') }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
      } else {
        var answers = [];
      }
    </script>
    @include('scripts.dynamic_form_script1')
</body>

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
</html>