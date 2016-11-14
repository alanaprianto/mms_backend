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

    <!-- Animation CSS -->
    <link href="{{ asset('resources/assets/css/animate.min.css') }}" rel="stylesheet">

    <link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/assets/css/register/style.css') }}" rel="stylesheet">
    <style>
      .ul-drop{
        display: none;
        list-style: none;
        padding: 7px 0px 7px 0px;
        position: absolute;
        min-width: 200px;
        background: #fff;
        margin-top: 10px;
        box-shadow: 0px 2px 10px #ccc;
        border-radius: 4px;
      }
      .ul-drop:before{
        font: normal normal normal 14px/1 FontAwesome;
        content: "\f0d8";
        color: #fff;
        margin-left: 20px;
        position: absolute;
        top: -16px;
        font-size: 25px;
      }
      .ul-drop li > a{
        padding: 20px 15px;
        padding: 10px 20px;
        display: list-item;
        font-size: 12px;
        cursor: pointer;
      }
      .ul-drop li > a:hover{
        text-decoration: none;
        background: #eee;
      }
    </style>
    @yield('head')
</head>
<body id="page-top">


  <div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header page-scroll">
          <a href="https://devtes.com/portal/kadin-indonesia" class="f_left logo">
              <img src="{{ asset('resources/assets/frontend/images/logo_kadin.png') }}" class="" style="max-width: 400px;" alt="">
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li class="@yield('infoactive')"><a class="page" href="{{ url('informasi')}}">Informasi</a></li>
              <li class="top-drop @yield('memberactive')">
                <a class="page" href="#">Anggota</a>
                <ul class="ul-drop">
                  <li><a href="{{ url('register1')}}">Anggota Biasa</a></li>
                  <li><a>Anggota Luar Biasa</a></li>
                </ul>
              </li>
              <li class="@yield('helpactive')"><a class="page" href="{{ url('bantuan')}}">Bantuan</a></li>
              @if(Auth::check())
                @if(Auth::user()->role==1)
                  <li class="@yield('loginactive')"><a class="page" href="{{ url('/crud/form/setting/')}}">Admin Panel</a></li>
                @elseif (Auth::user()->role==3)
                  <li class="@yield('loginactive')"><a class="page" href="{{ url('/dashboard/pusat')}}">Panel</a></li>
                @elseif (Auth::user()->role==4)
                  <li class="@yield('loginactive')"><a class="page" href="{{ url('/dashboard/provinsi')}}">Panel</a></li>
                @elseif (Auth::user()->role==5)
                  <li class="@yield('loginactive')"><a class="page" href="{{ url('/dashboard/daerah')}}">Panel</a></li>
                @else 
                  <li class="@yield('loginactive')"><a class="page" href="{{ url('/member')}}">Panel</a></li>
                @endif
                <li class="@yield('loginactive')"><a class="page" href="{{ url('logout')}}">Logout</a></li>
              @else
                <li class="@yield('loginactive')"><a class="page" href="{{ url('login')}}">Login</a></li>
              @endif              
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <section id="testimonials" class="navy-section testimonials">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 text-center wow zoomIn">
                  <i class="fa fa-users big-icon"></i>
                  <h1>
                      Pendaftaran Anggota Kadin
                  </h1>
                  <div class="testimonials-text">
                      <i>Pendaftaran anggota baru dan pendaftaran ulang anggota KADIN dapat dilakukan melalui Kadin Kota/Kabupaten setempat di seluruh Provinsi di Indonesia.</i>
                  </div>
                  <small>
                      <strong>01.11.2016 - Kadin Indonesia</strong>
                  </small>
              </div>
          </div>
      </div>
  </section>

  <section class="features">
    @yield('content')
  </section>

  <section id="contact" class="gray-section contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
          <p>© 2016 KADIN INDONESIA. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </section>

<script src="{{ asset('resources/assets/js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('resources/assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/classie.js') }}"></script>
<script src="{{ asset('resources/assets/js/cbpAnimatedHeader.js') }}"></script>
<script src="{{ asset('resources/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/register/inspinia.js') }}"></script>

<script>
  $(document).ready(function(){
    $('.top-drop').hover(function(){
      $('.ul-drop').toggle().addClass('fadeIn animated');
    })
  });
</script>
@stack('scripts')
</body>

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
</html>
