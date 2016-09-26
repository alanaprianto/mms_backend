<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
  <title>Kadin - 404</title>
  <meta name = "format-detection" content = "telephone=no" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!--meta info-->
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('resources/assets/frontend/images/fav_icon.ico') }}">
  <!--stylesheet include-->
  <link rel="stylesheet" type="text/css" media="all" href="{{ asset('resources/assets/frontend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" media="all" href="{{ asset('resources/assets/frontend/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('resources/assets/frontend/css/font-awesome.min.css') }}">
   <link rel="stylesheet" type="text/css" media="all" href="{{ asset('resources/assets/frontend/css/responsive.css') }}">
  <link rel="stylesheet" type="text/css" media="all" href="{{ asset('resources/assets/frontend/css/owl.carousel.css') }}">
  <!--modernizr-->
  <script src="{{ asset('resources/assets/frontend/js/jquery.modernizr.js') }}"></script>
  
</head>
<body class="wide_layout">
   
  <div class="loader"></div>
  <!--[if (lt IE 9) | IE 9]>
    <div class="ie_message_block">
      <div class="container">
        <div class="wrapper">
          <div class="clearfix"><i class="fa fa-exclamation-triangle f_left"></i><b>Attention!</b> This page may   not display correctly. You are using an outdated version of Internet Explorer. For a faster, safer browsing experience.<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode" class="button button_type_3 button_grey_light f_right" target="_blank">Update Now!</a></div>
        </div>
      </div>
    </div>
  <![endif]-->

  <!--cookie-->
  <!-- <div class="cookie">
          <div class="container">
            <div class="clearfix">
              <span>Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.</span>
              <div class="f_right"><a href="#" class="button button_type_3 button_orange">Accept Cookies</a><a href="#" class="button button_type_3 button_grey_light">Read More</a></div>
            </div>
          </div>
        </div>-->
  <div class="wrapper_container">
    <!--==============================header=================================-->
    <header role="banner" class="header header-main">
      <div class="h_top_part">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="header_top mobile_menu var2">
                <nav>
                  <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#">Contact</a></li>
                  </ul>
                </nav>
                <div class="login_block">
                  <ul>
                    <!--Login-->
                    <li class="login_button">
                      <a href="#" role="button"><i class="fa fa-user login_icon"></i>Login</a>
                      <div class="popup">
                        <form>
                          <ul>
                            <li>
                              <label for="username">Username</label><br>
                              <input type="text" name="" id="username">
                            </li>
                            <li>
                              <label for="password">Password</label><br>
                              <input type="password" name="" id="password">
                            </li>
                            <li>
                              <input type="checkbox" id="checkbox_10"><label for="checkbox_10">Remember me</label>
                            </li>
                            <li>
                              <a href="#" class="button button_orange">Log In</a>
                              <div class="t_align_c">
                                <a href="#" class="color_dark">Forgot your password?</a><br>
                                <a href="#" class="color_dark">Forgot your username?</a>
                              </div>
                            </li>
                          </ul>
                        </form>
                        <section class="login_footer">
                          <h3>PENDAFTARAN</h3>
                          <a href="#" class="button button_grey">Create an Account</a>
                        </section>
                      </div>
                    </li>
                    <!--language settings-->
                    <li class="lang_button">
                      <a role="button" href="#"><img src="images/flag_en.jpg" alt=""><span>English</span></a>
                      <ul class="dropdown_list">
                        <li><a href="#"><img src="images/flag_en.jpg" alt="">English</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="h_bot_part">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="clearfix">
                <a href="index.html" class="f_left logo"><img src="images/logo_kadin.png" alt=""></a>
                <!-- <a href="#" class="f_right"><img src="images/728x90.jpg" alt=""></a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--main menu container-->
      <div class="menu_wrap">
        <div class="menu_border">
          <div class="container clearfix menu_border_wrap">
            <!--button for responsive menu-->
            <button id="menu_button">
              Menu
            </button>
            <!--main menu-->
            <nav role="navigation" class="main_menu menu_var2">  
              <ul>
                <li class="current"><a href="{{ url('/') }}">Home<span class="plus"><i class="fa fa-plus-square-o"></i><i class="fa fa-minus-square-o"></i></span></a>
                  
                </li>
                <li class="menu_4"><a href="#">Profil<span class="plus"><i class="fa fa-plus-square-o"></i><i class="fa fa-minus-square-o"></i></span></a>
                  <!--sub menu-->
                  <div class="sub_menu_wrap type_2 clearfix">
                    <ul>
                      <li><a href="404">Sejarah</a></li>
                      <li><a href="404">UU / AD / ART KADIN</a></li>
                      <li><a href="404">Peraturan dan Pedoman Organisasi</a></li>
                      <li><a href="404">Lambang Mars dan Hymne</a></li>
                      <li><a href="404">Structur Organisasi</a></li>
                      <li><a href="404">Visi dan Misi</a></li>
                      <li><a href="404">Dewan Kehormatan</a></li>
                      <li><a href="404">Dewan Penasihat</a></li>
                      <li><a href="404">Dewan Pertimbangan</a></li>
                      <li><a href="404">Dewan Pengurus</a></li>
                      <li><a href="404">Dewan Pakar</a></li>
                      <li><a href="404">Kadin Daerah</a></li>
                      <li><a href="404">Komite birateral dan Multilateral</a></li>
                      <li><a href="404">Lembaga / Badan dibawah kadin</a></li>
                      <li><a href="404">Sekertariat Kadin</a></li>
                      <li><a href="404">Program Kerja</a></li>
                    </ul>
                  </div>
                </li>
                <li class="menu_4"><a href="#">Keanggotaan<span class="plus"><i class="fa fa-plus-square-o"></i><i class="fa fa-minus-square-o"></i></span></a>
                  <!--sub menu-->
                  <div class="sub_menu_wrap type_2 clearfix">
                    <ul>
                      <li><a href="404">Anggota Kadin</a></li>
                      <li><a href="404">Asosiasi / Himpunan</a></li>
                      <li><a href="404">Asosiasi Teraktreditasi</a></li>
                      <li><a href="404">Persyaratan dan Prosedur</a></li>
                      <li><a href="404">Perusahaan Terintegrasi</a></li>
                      <li><a href="404">Pendaftaran Online</a></li>
                      <li><a href="404">Layanan ATA Carnet</a></li>
                    </ul>
                  </div>
                </li>
                <li class="menu_4"><a href="#">Berita<span class="plus"><i class="fa fa-plus-square-o"></i><i class="fa fa-minus-square-o"></i></span></a>
                  <!--sub menu-->
                  <div class="sub_menu_wrap type_2 clearfix">
                    <ul>
                      <li><a href="404">Berita Ketua Umum</a></li>
                      <li><a href="404">Berita Kadin</a></li>
                      <li><a href="404">Galeri Kegiatan</a></li>
                    </ul>
                  </div>
                </li>
                <li class="menu_4"><a href="page_contact.html">Hubungi kami<span class="plus"><i class="fa fa-plus-square-o"></i><i class="fa fa-minus-square-o"></i></span></a>
                </li>
              </ul>
            </nav>
            <div class="search-holder">
              <div class="search_box">
                <button class="search_button button button_orange_hover">
                  <i class="fa fa-search"></i>
                </button>
              </div>
              <!--search form-->
              <div class="searchform_wrap var2">
                <div class="container vc_child h_inherit relative">
                  <form role="search">
                    <input type="text" name="search" placeholder="Type search text and hit enter">
                  </form>
                  <button class="close_search_form">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!--==============================content================================-->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-0"></div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="section page_404">
              <h2 class="title_404">404</h2>
              <h2 class="section_title section_title_big">Page Not Found!</h2>
              <p>We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it and we'll try to fix it. In the meantime, try one of these options:</p>
              <div class="buttons_404">
                <a href="index.html" class="button button_type_2 button_grey_light">Go to Previous page</a>
                <a href="index.html" class="button button_type_2 button_grey_light">Go to Home page</a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-0"></div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-0"></div>
        </div>
    </div>
    <!--==============================footer=================================-->
    <!--markup footer-->
    <footer class="footer footer_4">
      <div class="top_footer_banner">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="widget_social_icons clearfix" data-appear-animation="fadeInDown" data-appear-animation-delay="1150">
                <ul>
                  <li class="facebook">
                    <span class="tooltip">Facebook</span>
                    <a href="#">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </li>
                  <li class="twitter">
                    <span class="tooltip">Twitter</span>
                    <a href="#">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li>
                  <li class="google_plus">
                    <span class="tooltip">Google+</span>
                    <a href="#">
                      <i class="fa fa-google-plus"></i>
                    </a>
                  </li>
                  <li class="rss">
                    <span class="tooltip">Rss</span>
                    <a href="#">
                      <i class="fa fa-rss"></i>
                    </a>
                  </li>
                  <li class="pinterest">
                    <span class="tooltip">Pinterest</span>
                    <a href="#">
                      <i class="fa fa-pinterest"></i>
                    </a>
                  </li>
                  <li class="instagram">
                    <span class="tooltip">Instagram</span>
                    <a href="#">
                      <i class="fa fa-instagram"></i>
                    </a>
                  </li>
                  <li class="linkedin">
                    <span class="tooltip">LinkedIn</span>
                    <a href="#">
                      <i class="fa fa-linkedin"></i>
                    </a>
                  </li>
                  <li class="vimeo">
                    <span class="tooltip">Vimeo</span>
                    <a href="#">
                      <i class="fa fa-vimeo-square"></i>
                    </a>
                  </li>
                  <li class="youtube">
                    <span class="tooltip">Youtube</span>
                    <a href="#">
                      <i class="fa fa-youtube-play"></i>
                    </a>
                  </li>
                  <li class="flickr">
                    <span class="tooltip">Flickr</span>
                    <a href="#">
                      <i class="fa fa-flickr"></i>
                    </a>
                  </li>
                  <li class="envelope">
                    <span class="tooltip">Contact Us</span>
                    <a href="#">
                      <i class="fa fa-envelope-o"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="widget_newsletter form_section" data-appear-animation="fadeInDown" data-appear-animation-delay="1150">
                <form id="newsletter">
                  <button type="submit" class="btn-email button button_grey_light" data-type="submit"><i class="fa fa-envelope-o"></i></button>
                  <div class="wrapper">
                    <input type="email" placeholder="Your email address" name="newsletter-email">
                  </div> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer_top_part">
        <div class="container">
          <div class="row">
            
          </div>
        </div>
      </div>
      <!--copyright part-->
      <div class="footer_bottom_part">
        <div class="container clearfix">
          <p>&copy; 2016 <span>Nusoft</span>. All Rights Reserved.</p>
          <div class="mobile_menu">
            <nav>
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="#">Keanggotaan</a></li>
                <li><a href="#">Berita</a></li>
                <li><a href="#">Hubungi Kami</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!--scripts include-->
  <script src="{{ asset('resources/assets/frontend/js/jquery-2.1.0.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/jquery.queryloader2.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/jflickrfeed.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/retina.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/circles.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/plugins/twitter/jquery.tweet.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/plugins.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/script.js') }}"></script>


</body>
</html>