<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
  <title>Kadin - Home</title>
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
  <link rel="stylesheet" type="text/css" media="all" href="{{ asset('resources/assets/frontend/css/animate.css') }}">
  <link rel="stylesheet" type="text/css" media="all" href="{{ asset('resources/assets/frontend/plugins/layerslider/css/layerslider.css') }}">
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Contact</a></li>
                  </ul>
                </nav>
                <div class="login_block">
                  <ul>
                    <!--Login-->
                    <li class="login_button">
                      <a href="#" role="button"><i class="fa fa-user login_icon"></i>Login</a>
                      <div class="popup">
                        @include('errors.error_list')
                        {!! Form::open(['action' => ['LoginController@login']]) !!}
                          <ul>
                            <li>
                              <label for="username">Username</label><br>
                              <input type="text" name="username" id="username">
                            </li>
                            <li>
                              <label for="password">Password</label><br>
                              <input type="password" name="password" id="password">
                            </li>
                            <li>
                              <input type="checkbox" id="checkbox_10"><label for="checkbox_10">Remember me</label>
                            </li>
                            <li>
                              <!-- <a href="#" class="button button_orange">Log In</a> -->
                              {!! Form::submit('Log In', ['class' => 'button button_orange']) !!}
                              <div class="t_align_c">
                                <a href="#" class="color_dark">Forgot your password?</a><br>
                                <a href="#" class="color_dark">Forgot your username?</a>
                              </div>
                            </li>
                          </ul>
                        {!! Form::close() !!}
                        <section class="login_footer">
                          <h3>PENDAFTARAN</h3>
                          <a href="#" class="button button_grey">Create an Account</a>
                        </section>
                      </div>
                    </li>
                    <!--language settings-->
                    <li class="lang_button">
                      <a role="button" href="#"><img src="{{ asset('resources/assets/frontend/images/flag_en.jpg') }}" alt=""><span>English</span></a>
                      <ul class="dropdown_list">
                        <li><a href="#"><img src="{{ asset('resources/assets/frontend/images/flag_en.jpg') }}" alt="">English</a></li>
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
                <a href="index.html" class="f_left logo"><img src="{{ asset('resources/assets/frontend/images/logo_kadin.png') }}" alt=""></a>
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
                      <li id="register"><a href="#register">Pendaftaran Online</a></li>
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
                @if(Auth::check())                                      
                  <li class="menu_4"><a href="#">{{ Auth::user()->name }}<span class="plus"><i class="fa fa-plus-square-o"></i><i class="fa fa-minus-square-o"></i></span></a>
                  <!--sub menu-->
                  <div class="sub_menu_wrap type_2 clearfix">
                    <ul>
                      <li><a href="profile">Profile</a></li>
                      <li><a href="logout">Logout</a></li>                      
                    </ul>
                  </div>
                </li>    
                @endif                    
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
        <!-- ========layerslider======== -->
        <div id="layerslider" class="section_8" style="width: 100%; height: 500px;" data-appear-animation="fadeInDown" data-appear-animation-delay="1150">

          <div class="ls-layer slide1" style="slidedirection: top; slidedelay: 8000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; transition3d: all;"> <img src="{{ asset('resources/assets/frontend/images/cargo.jpg') }}" class="ls-bg" alt="Slide background">
            <div class="ls-s4  slide-text1" style="position: absolute; top: 50%; right: 0; slidedirection : bottom; slideoutdirection : top;  durationin : 1500; durationout : 1500; easingin: easeInOutQuint; easingout : easeInOutQuint; delayin : 0; delayout : 100; showuntil : 0;">
              <div class="caption_inner layer_slide_text">
                
                <a href="#"><h2>INDONESIAN CHAMBER OF COMMERCE & INDUSTRY</h2></a>
              </div>
            </div>
          </div>

          <div class="ls-layer slide2" style="slidedirection: top; slidedelay: 8000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; transition3d: all;"> <img src="{{ asset('resources/assets/frontend/images/bisnis.jpg') }}" class="ls-bg" alt="Slide background">
            <div class="ls-s4  slide-text1" style="position: absolute; top: 50%; right: 0; slidedirection : bottom; slideoutdirection : top;  durationin : 1500; durationout : 1500; easingin: easeInOutQuint; easingout : easeInOutQuint; delayin : 0; delayout : 100; showuntil : 0;">
              <div class="caption_inner layer_slide_text">
                
                <a href="#"><h2>INDONESIAN CHAMBER OF COMMERCE & INDUSTRY</h2></a>
              </div>
            </div>
          </div>

          <div class="ls-layer slide3" style="slidedirection: top; slidedelay: 8000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; transition3d: all;"> <img src="{{ asset('resources/assets/frontend/images/bisnis1.jpg') }}" class="ls-bg" alt="Slide background">
            <div class="ls-s4  slide-text1" style="position: absolute; top: 50%; right: 0; slidedirection : bottom; slideoutdirection : top;  durationin : 1500; durationout : 1500; easingin: easeInOutQuint; easingout : easeInOutQuint; delayin : 0; delayout : 100; showuntil : 0;">
              <div class="caption_inner layer_slide_text">
                
                <a href="#"><h2>INDONESIAN CHAMBER OF COMMERCE & INDUSTRY</h2></a>
              </div>
            </div>
          </div>

        </div>
        <!-- ======== End layerslider======== -->

        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12">
            <!--Author info-->
            <div class="section">
              <h2 class="section_title section_title_big">Sambutan Ketua Umum Kadin Indonesia</h2>
              <div class="author_details clearfix">
                <div class="f_left">
                  <div>
                    <img src="{{ asset('resources/assets/frontend/images/ketua.jpg') }}" alt="">
                  </div>
                </div>
                <div>
                  <p>Assalamu'alaikum Wr. Wb.,</p>
                    <p>Salam Sejahtera bagi kita semua,</p>
                    <p>Salam sukses bagi Pengusaha Indonesia...</p>

                   <p> Kamar Dagang dan Industri (Kadin) Indonesia merupakan organisasi yang menjadi payung bagi dunia usaha Indonesia. Berdasarkan UU No.1 tahun 1987, Kadin Indonesia adalah satu-satunya organisasi yang mewadahi para pengusaha Indonesia dan landasan operasional kegiatannya berpedoman pada  Anggaran Dasar dan Anggaran  Rumah Tangga Kadin yang disahkan dengan Keputusan Presiden RI, terakhir dengan Keppres No. 17 Tahun 2010.</p>
                  <div class="widget widget_social_icons type_2 type_border clearfix">
                    <ul>
                      <li class="website">
                        <span class="tooltip">Website</span>
                        <a href="#">
                          <i class="fa fa-home"></i>
                        </a>
                      </li>
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
                        <span class="tooltip">Email</span>
                        <a href="#">
                          <i class="fa fa-envelope-o"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--Author Posts-->
            <div class="section read_post_list">
              <h3 class="section_title">Berita</h3>
              <ul class="row">
                <!--Left Post-->
                <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="section_post_left">
                    <div class="scale_image_container">
                      <a href="#"><img src="{{ asset('resources/assets/frontend/images/news1.jpg') }}" alt="" class="scale_image"></a>
                      <div class="post_image_buttons">
                        <a href="#" class="button banner_button business">business</a>
                        <a href="#" class="icon_box">
                          <i class="fa fa-file-text"></i>
                        </a>
                      </div>
                    </div>
                    <div class="clearfix">
                      <div class="f_left">
                        <div class="event_date">July 01, 2014 5:50 am</div>
                      </div>
                      <div class="f_right event_info">
                        <a href="#">
                          <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                          <span>5</span>
                        </a>
                        <a href="#">
                          <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                          <span>73</span>
                        </a>
                        <a href="#">
                          <i class="fa fa-eye d_inline_m m_right_3"></i> 
                          <span>192</span>
                        </a>
                      </div>
                    </div>
                    <div class="post_text">
                      <h3 class="post_title"><a href="#">KADIN Sambut Positif Kebijakan XII</a></h3>
                      <p>Ketua Umum Kadin Indonesia Rosan Roeslani menyambut positif kebijakan paket ekonomi jilid XII yang diumumkan oleh Presiden Joko Widodo. Paket kebijakan tersebut salah satunya mencakup tentang ease of doing business atau kemudahan berbisnis di Indonesia </p>
                      <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                    </div>
                  </div>
                </li>
                <!--Right Post-->
                <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="section_post_right">
                    <div class="scale_image_container">
                      <a href="#"><img src="{{ asset('resources/assets/frontend/images/news2.jpg') }}" alt="" class="scale_image"></a>
                      <div class="post_image_buttons">
                        <a href="#" class="button banner_button business">business</a>
                        <a href="#" class="icon_box">
                          <i class="fa fa-file-text"></i>
                        </a>
                      </div>
                      <div class="canvas">
                        <div class="circle" id="circles-1"></div>
                        <br />
                      </div>
                    </div>
                    <div class="clearfix">
                      <div class="f_left">
                        <div class="event_date">July 01, 2014 5:50 am</div>
                      </div>
                      <div class="f_right event_info">
                        <a href="#">
                          <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                          <span>5</span>
                        </a>
                        <a href="#">
                          <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                          <span>73</span>
                        </a>
                        <a href="#">
                          <i class="fa fa-eye d_inline_m m_right_3"></i> 
                          <span>192</span>
                        </a>
                      </div>
                    </div>
                    <div class="post_text">
                      <h3 class="post_title"><a href="#">Kadin dan BEI Genjot Minat Perusahaan Jatim untuk Go Public</a></h3>
                      <p>Kamar Dagang dan Industri (Kadin) Indonesia dan PT Bursa Efek Indonesia (BEI) bekerja sama menambah jumlah perusahaan tercatat (emiten) di pasar modal, tidak terkecuali bagi perusahaan-perusahaan di daerah-daerah yang memiliki potensi besar untuk melakukan Initial Public Offering (IPO), sehingga perusahaan itu bisa mendapatkan pembiayaan alternatif selain dari perbankan. </p>
                      <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="row">
                <!--Left Post-->
                <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="section_post_left">
                    <div class="scale_image_container">
                      <a href="#"><img src="{{ asset('resources/assets/frontend/images/news3.jpg') }}" alt="" class="scale_image"></a>
                      <div class="post_image_buttons">
                        <a href="#" class="button banner_button business">Business</a>
                        <a href="#" class="icon_box">
                          <i class="fa fa-file-text"></i>
                        </a>
                      </div>
                    </div>
                    <div class="clearfix">
                      <div class="f_left">
                        <div class="event_date">July 01, 2014 5:50 am</div>
                      </div>
                      <div class="f_right event_info">
                        <a href="#">
                          <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                          <span>5</span>
                        </a>
                        <a href="#">
                          <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                          <span>73</span>
                        </a>
                        <a href="#">
                          <i class="fa fa-eye d_inline_m m_right_3"></i> 
                          <span>192</span>
                        </a>
                      </div>
                    </div>
                    <div class="post_text">
                      <h3 class="post_title"><a href="#">KADIN dan IBAI Teken MoU Peningkatan Perdagangan</a></h3>
                      <p>Dalam rangka menggenjot perdagangan dan investasi diantara kedua negara, Kamar Dagang dan Industri (Kadin) Indonesia menandatangani Memorandum of Understanding (MoU) dengan Italian Business Association in Indonesia (IBAI) di Jakarta, Rabu (27/4/2016).</p>
                      <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                    </div>
                  </div>
                </li>
                <!--Right Post-->
                <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="section_post_right">
                    <div class="scale_image_container">
                      <a href="#"><img src="{{ asset('resources/assets/frontend/images/news4.jpg') }}" alt="" class="scale_image"></a>
                      <div class="post_image_buttons">
                        <a href="#" class="button banner_button business">business</a>
                        <a href="#" class="icon_box">
                          <i class="fa fa-video-camera"></i>
                        </a>
                      </div>
                    </div>
                    <div class="clearfix">
                      <div class="f_left">
                        <div class="event_date">July 01, 2014 5:50 am</div>
                      </div>
                      <div class="f_right event_info">
                        <a href="#">
                          <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                          <span>5</span>
                        </a>
                        <a href="#">
                          <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                          <span>73</span>
                        </a>
                        <a href="#">
                          <i class="fa fa-eye d_inline_m m_right_3"></i> 
                          <span>192</span>
                        </a>
                      </div>
                    </div>
                    <div class="post_text">
                      <h3 class="post_title"><a href="#">Kadin dan Kemenaker Teken Kerjasama Tingkatkan Daya Saing Tenaga Kerja</a></h3>
                      <p>Dalam rangka meningkatkan produktivitas dan daya saing kompetensi tenaga kerja melalui pengembangan program pelatihan terpadu, yang meliputi program pelatihan, pemagangan dan sertifikasi, Kamar Dagang dan Industri (Kadin) Indonesia melakukan perjanjian kerja sama dengan Kementerian Ketenagakerjaan RI.</p>
                      <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="row">
                <!--Left Post-->
                <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="section_post_left">
                    <div class="scale_image_container">
                      <a href="#"><img src="{{ asset('resources/assets/frontend/images/news5.jpg') }}" alt="" class="scale_image"></a>
                      <div class="post_image_buttons">
                        <a href="#" class="button banner_button business">business</a>
                        <a href="#" class="icon_box">
                          <i class="fa fa-volume-up"></i>
                        </a>
                      </div>
                      <div class="canvas">
                        <div class="circle" id="circles-2"></div>
                        <br />
                      </div>
                    </div>
                    <div class="clearfix">
                      <div class="f_left">
                        <div class="event_date">July 01, 2014 5:50 am</div>
                      </div>
                      <div class="f_right event_info">
                        <a href="#">
                          <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                          <span>5</span>
                        </a>
                        <a href="#">
                          <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                          <span>73</span>
                        </a>
                        <a href="#">
                          <i class="fa fa-eye d_inline_m m_right_3"></i> 
                          <span>192</span>
                        </a>
                      </div>
                    </div>
                    <div class="post_text">
                      <h3 class="post_title"><a href="#">Jadi Pusat Teknologi di Eropa, Kadin Ajak Belgia Investasi di RI</a></h3>
                      <p>Kamar Dagang dan Industri (Kadin) Indonesia mengajak pengusaha Belgia untuk meningkatkan dan menanamkan investasi di Indonesia.</p>
                      <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                    </div>
                  </div>
                </li>
                <!--Right Post-->
                <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="section_post_right">
                    <div class="scale_image_container">
                      <a href="#"><img src="{{ asset('resources/assets/frontend/images/news6.jpg') }}" alt="" class="scale_image"></a>
                      <div class="post_image_buttons">
                        <a href="#" class="button banner_button business">business</a>
                        <a href="#" class="icon_box">
                          <i class="fa fa-file-text"></i>
                        </a>
                      </div>
                    </div>
                    <div class="clearfix">
                      <div class="f_left">
                        <div class="event_date">July 01, 2014 5:50 am</div>
                      </div>
                      <div class="f_right event_info">
                        <a href="#">
                          <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                          <span>5</span>
                        </a>
                        <a href="#">
                          <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                          <span>73</span>
                        </a>
                        <a href="#">
                          <i class="fa fa-eye d_inline_m m_right_3"></i> 
                          <span>192</span>
                        </a>
                      </div>
                    </div>
                    <div class="post_text">
                      <h3 class="post_title"><a href="#">Kadin Dukung Penuh Pemerintah dalam EU-CEPA</a></h3>
                      <p>Kamar Dagang dan Industri (KADIN) Indonesia mendukung penuh pemerintah Indonesia dalam perjanjian kemitraan ekonomi EU-CEPA. Berdasarkan rencana hari ini (Kamis 21 April) di Brussels Belgia akan berlangsung pertemuan antara Presiden Indonesia Joko Widodo dengan Presiden Komisi Eropa Jean Claude Juncker, guna menyelesaikan diskusi awal (preparatory discussion) mengenai Comprehensive Economic Partnership Agreement (CEPA).</p>
                      <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                    </div>
                  </div>
                </li>
              </ul>
              
              
              <div class="more_news">
                <ul class="row">
                  <!--Left Post-->
                  <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="section_post_left">
                      <div class="scale_image_container">
                        <a href="#"><img src="{{ asset('resources/assets/frontend/images/news6.jpg') }}" alt="" class="scale_image"></a>
                        <div class="post_image_buttons">
                          <a href="#" class="button banner_button business">business</a>
                          <a href="#" class="icon_box">
                            <i class="fa fa-volume-up"></i>
                          </a>
                        </div>
                      </div>
                      <div class="clearfix">
                        <div class="f_left">
                          <div class="event_date">July 01, 2014 5:50 am</div>
                        </div>
                        <div class="f_right event_info">
                          <a href="#">
                            <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                            <span>5</span>
                          </a>
                          <a href="#">
                            <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                            <span>73</span>
                          </a>
                          <a href="#">
                            <i class="fa fa-eye d_inline_m m_right_3"></i> 
                            <span>192</span>
                          </a>
                        </div>
                      </div>
                      <div class="post_text">
                        <h2 class="post_title"><a href="#">Aliquam erat volutpat</a></h2>
                        <p>Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit.</p>
                        <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                      </div>
                    </div>
                  </li>
                  <!--Right Post-->
                  <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="section_post_right">
                      <div class="scale_image_container">
                        <a href="#"><img src="{{ asset('resources/assets/frontend/images/news6.jpg') }}" alt="" class="scale_image"></a>
                        <div class="post_image_buttons">
                          <a href="#" class="button banner_button business">business</a>
                          <a href="#" class="icon_box">
                            <i class="fa fa-file-text"></i>
                          </a>
                        </div>
                      </div>
                      <div class="clearfix">
                        <div class="f_left">
                          <div class="event_date">July 01, 2014 5:50 am</div>
                        </div>
                        <div class="f_right event_info">
                          <a href="#">
                            <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                            <span>5</span>
                          </a>
                          <a href="#">
                            <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                            <span>73</span>
                          </a>
                          <a href="#">
                            <i class="fa fa-eye d_inline_m m_right_3"></i> 
                            <span>192</span>
                          </a>
                        </div>
                      </div>
                      <div class="post_text">
                        <h2 class="post_title"><a href="#">Sed laoreet aliquam leo</a></h2>
                        <p>Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipisMauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet.</p>
                        <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                      </div>
                    </div>
                  </li>
                </ul>
                <ul class="row">
                  <!--Left Post-->
                  <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="section_post_left">
                      <div class="scale_image_container">
                        <a href="#"><img src="{{ asset('resources/assets/frontend/images/review_img3.jpg') }}" alt="" class="scale_image"></a>
                        <div class="post_image_buttons">
                          <a href="#" class="button banner_button business">Business</a>
                          <a href="#" class="icon_box">
                            <i class="fa fa-file-text"></i>
                          </a>
                        </div>
                      </div>
                      <div class="clearfix">
                        <div class="f_left">
                          <div class="event_date">July 01, 2014 5:50 am</div>
                        </div>
                        <div class="f_right event_info">
                          <a href="#">
                            <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                            <span>5</span>
                          </a>
                          <a href="#">
                            <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                            <span>73</span>
                          </a>
                          <a href="#">
                            <i class="fa fa-eye d_inline_m m_right_3"></i> 
                            <span>192</span>
                          </a>
                        </div>
                      </div>
                      <div class="post_text">
                        <h2 class="post_title"><a href="#">Lorem ipsum dolor sit amet</a></h2>
                        <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. </p>
                        <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                      </div>
                    </div>
                  </li>
                  <!--Right Post-->
                  <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="section_post_right">
                      <div class="scale_image_container">
                        <a href="#"><img src="{{ asset('resources/assets/frontend/images/review_img1.jpg') }}" alt="" class="scale_image"></a>
                        <div class="post_image_buttons">
                          <a href="#" class="button banner_button business">business</a>
                          <a href="#" class="icon_box">
                            <i class="fa fa-video-camera"></i>
                          </a>
                        </div>
                      </div>
                      <div class="clearfix">
                        <div class="f_left">
                          <div class="event_date">July 01, 2014 5:50 am</div>
                        </div>
                        <div class="f_right event_info">
                          <a href="#">
                            <i class="fa fa-comments-o d_inline_m m_right_3"></i> 
                            <span>5</span>
                          </a>
                          <a href="#">
                            <i class="fa fa fa-heart-o d_inline_m m_right_3"></i> 
                            <span>73</span>
                          </a>
                          <a href="#">
                            <i class="fa fa-eye d_inline_m m_right_3"></i> 
                            <span>192</span>
                          </a>
                        </div>
                      </div>
                      <div class="post_text">
                        <div class="post_theme">Exlusive</div><h2 class="post_title"><a href="#">Etiam cursus leo vel</a></h2>
                        <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. </p>
                        <a href="#" class="button button_type_2 button_grey_light">Selanjutnya</a>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="load_more_wrapper">
                <h3 class="section_title"><a href="#" class="more_news_button">Berita Lainnya</a></h3>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <!--Kalender Acara-->
            <div class="section">
              <h3 class="section_title">Kalender Acara</h3>
                <div class="tabs vertical clearfix">
                  <!--tabs navigation-->
                  <ul class="tabs_nav clearfix">
                    <li class=""><a href="#tab-4"><h3>22/11/2015</h3></a></li>
                    <li class=""><a href="#tab-5"><h3>29/10/2015</h3></a></li>
                    <li class=""><a href="#tab-6"><h3>07/10/2015</h3></a></li>
                  </ul>
                  <!--tabs content-->
                  <div class="tabs_content">
                    <div id="tab-4">
                      <p>Musyawarah Nasional (MUNAS) VII Kamar Dagang dan Industri | The Trans Luxury Hotel-Bandung, 22-24 November 2015</p>
                    </div>
                    <div id="tab-5">
                      <p>Rapat Kerja Nasional (RAKERNAS) Kadin Indonesia Bidang ICT dan Penyiaran | Kamis, 5 November 2015 | Ruang AEBC, Kadin Indonesia</p>
                    </div>
                    <div id="tab-6">
                      <p>Jakarta International Expo 2015 | 7-9 Okotober 2015 | Kemayoran, Jakarta</p>
                    </div>
                  </div>
              </div>
            </div>
            <div class="section t_align_c">
              <div class="box_image_conteiner">
                <a href="#"><img src="{{ asset('resources/assets/frontend/images/ata.jpg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('resources/assets/frontend/images/databis.png') }}" alt=""></a>
              </div>
            </div>
          </div>
        </div>
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
  <script src="{{ asset('resources/assets/frontend/js/apear.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/circles.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/plugins/twitter/jquery.tweet.min.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/plugins/layerslider/js/greensock.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/plugins/layerslider/js/layerslider.kreaturamedia.jquery.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/plugins/layerslider/js/layerslider.transitions.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/plugins.js') }}"></script>
  <script src="{{ asset('resources/assets/frontend/js/script.js') }}"></script>

  
  <script>
    var colors = [['#fa985d', '#ffffff']], circles = [];
    var child = document.getElementById('circles-3');
    circles.push(Circles.create({
        id:         child.id,
        value:      6.2,
        radius:     14,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-4');
    circles.push(Circles.create({
        id:         child.id,
        value:      6.2,
        radius:     14,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-8');
    circles.push(Circles.create({
        id:         child.id,
        value:      8.0,
        radius:     19,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-9');
    circles.push(Circles.create({
        id:         child.id,
        value:      7.7,
        radius:     19,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-10');
    circles.push(Circles.create({
        id:         child.id,
        value:      9.2,
        radius:     19,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-11');
    circles.push(Circles.create({
        id:         child.id,
        value:      7.4,
        radius:     14,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-12');
    circles.push(Circles.create({
        id:         child.id,
        value:      6.5,
        radius:     14,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-13');
    circles.push(Circles.create({
        id:         child.id,
        value:      8.6,
        radius:     14,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));

    var child = document.getElementById('circles-14');
    circles.push(Circles.create({
        id:         child.id,
        value:      9.3,
        radius:     14,
        width:      3,
        maxValue:   10,
        duration:   1000,
        text:       function(value){return value;},
        colors:    ['#fa985d', '#ffffff']
    }));
  </script>

  <script>
    $('#layerslider').layerSlider({
      autoStart: false,
      responsive: true,
      skinsPath : '',
      imgPreload : false,
      navPrevNext: true,
      navButtons: false,
      hoverPrevNext: false,
      responsiveUnder : 940
    });
  </script>
  
  <script type="text/javascript">
    $('#register').on('click', function (event) {  
      var url =  "{{ url('/register1/')}}";
      $('.content').html("<iframe src="+url+" frameborder='0' scrolling='no' onload='resizeIframe(this)'></iframe>");
      // $.ajax({
      //   type:'GET',
      //   url :"{{ url('/register1/')}}",        
      //   success: function(data) {
      //     console.log('success', data);          
      //   },
      //   error:function(exception){alert('Exeption:'+exception);}
      // }); 
      // event.preventDefault();
    });

    function resizeIframe(obj) {
      obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }
  </script>
</body>
</html>