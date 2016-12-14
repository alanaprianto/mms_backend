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
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">    

    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/assets/css/register/style.css') }}" rel="stylesheet">    
</head>
<body id="page-top">

  <section class="features">
    <div class="container">
		<div class="row features-block">
			<!--<div class="col-lg-12 features-text wow fadeInLeft">-->
			<div class="col-lg-12 features-text wow fadeInLeft">
				<strong>REGISTER MEMBER KEANGGOTAAN KADIN INDONESIA</strong><br/>
				<small>Silahkan isi data pada form dibawah ini !</small><br/><br/>
				@include('errors.error_list')

				{!! Form::open(['action' => ['KadinDaerahController@store'], 'id' => 'wadah']) !!}
                    <input type="hidden" name="alb" value="false">

				{!! Form::close() !!}
			</div>
		</div>
	</div>
  </section>

<script src="{{ asset('resources/assets/js/jquery-2.1.1.js') }}"></script>
    {{ $alb = false }}
    @include('dynamic_form_script')
</body>

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
</html>