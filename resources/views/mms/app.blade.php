<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Kadin MMS</title>    
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">            
    <style type="text/css">
        div.feature {
        position: relative;
        }

        div.feature a {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-decoration: none; /* No underlines on the link */
            z-index: 10; /* Places the link above everything else in the div */
            background-color: #FFF; /* Fix to make div clickable in IE */
            opacity: 0; /* Fix to make div clickable in IE */
            filter: alpha(opacity=1); /* Fix to make div clickable in IE */
        }
    </style>
    @yield('styles')
</head>
<body id="page-top">
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">       
            <div class="navbar-collapse feature">
                <a href="#home"></a>
                <div class="col-md-2 fluid">
                    <img alt="Brand" src="{{ asset('resources/img/LogoKadin.gif') }}">    
                </div>
                <div class="col-md-10 navbar-brand" style="padding-top:6px;">
                    Sistem Informasi Manajemen Keanggotaan<br>
                    Kamar Dagang dan Industri<br>
                    Indonesia<br>                                                     
                </div>
            </div>  
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">      
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button class="btn btn-submit-md" type="submit">
                        <span class="glyphicon glyphicon-search">
                    </button> 
                </form>
                <ul class="nav navbar-nav navbar-right" style="margin-right:30px;">
                    <li id="info"><a href="info">Info</a></li>
                    <li class="dropdown"><a class="dropbtn" data-toggle="dropdown" href="pendaftaran">Pendaftaran <span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li id="pendaftaran1"><a href="pendaftaran1">Pendaftaran Anggota Biasa</a></li>
                        <li id="pendaftaran2"><a href="pendaftaran2">Pendaftaran Anggota Luar Biasa</a></li>
                    </ul>
                    </li>
                    <li id="login"><a href="login">Login</a></li>
                    <li id="help"><a href="help">Help</a></li>                        
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="col-md-12" style="padding-right: 0; padding-left: 0;">
        <div id="content" class="col-md-8" style="height: 500px;">
            @yield('content')
        </div>
        <div id="sidebar" class="col-md-4" style="height: 500px; padding-top:0;">
            <div class="well">
                <h2>Sidebar</h2>
            </div>
        </div>
    </div>
    <div class="col-md-12 well">
        <h1>FOOTER</h1>
    </div>
</div>

<script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.js') }}"></script>     
<script type="text/javascript">
    var classname = document.getElementsByClassName("feature");

    var getHome = function() {
        $.ajax({    
            url: "/mms/"
        }).done(function(data) {                    
            $('#content').html(data);
        });
    };

    for (var i = 0; i < classname.length; i++) {
        classname[i].addEventListener('click', getHome, false);
    }

    $(window).on('load', function(e) {              
        var element = document.getElementById("content");
        
        resizeElementHeight(element);
    });

    function resizeElementHeight(element) {
        var height = 0;
        var body = window.document.body;
        if (window.innerHeight) {
            height = window.innerHeight;
        } else if (body.parentElement.clientHeight) {
            height = body.parentElement.clientHeight;
        } else if (body && body.clientHeight) {
            height = body.clientHeight;
        }
        element.style.height = ((height - element.offsetTop) + "px");
    }    
</script>
@yield('scripts') 
</body>
</html>