<!DOCTYPE html>
<html>
    <head>
        <title>MMS Backend</title>
                   
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Simple Sidebar CSS -->
        <!-- <link href="{{ asset('resources/assets/css/simple-sidebar.css') }}" rel="stylesheet">        -->
        <!-- Datatables CSS -->
        <!-- <link href="{{ asset('resources/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('resources/assets/css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('resources/assets/css/plugins/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('resources/assets/css/plugins/dataTables/dataTables.tableTools.min.css') }}" rel="stylesheet">
        <!-- Toastr -->
        <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/plugins/toastr/toastr.min.css') }}">  
        <!-- Font Awesome -->
        <link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <!-- Gritter -->
        <link href="{{ asset('resources/assets/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

        <link href="{{ asset('resources/assets/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">

        <!-- <link href="{{ asset('resources/assets/css/plugins/cropper/cropper.min.css') }}" rel="stylesheet"> -->
        
        <!-- Kraaje Fileinputmin CSS -->
        <!-- <link href="{{ asset('resources/assets/css/fileinput.min.css') }}" rel="stylesheet"> -->
        @yield('head')
    </head>
    <body>                          
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a href="" data-toggle="modal" data-target="#profileimgModal">
                                <span>
                                    <img alt="image" class="img-circle" src="{{ url('/images') }}/{{ Auth::user()->username}}" height="48" width="48" />
                                </span>
                            </a>                            
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">{{ Auth::user()->myrole->name }}<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{ url('profile') }}">Profile</a></li>
                                <li><a href="{{ url('contacts') }}">Contacts</a></li>
                                <li><a href="{{ url('mailbox') }}">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            <img class="logo-name" src="{{ asset('resources/img/icon144-128x128-10.png') }}" height="48" width="48"/>
                        </div>
                    </li>                    
                    <!-- @yield('sidebar') -->
                                        
                    <li class="@yield('active-groupnr')">
                      <a href="#">
                        <i class="fa fa-list-alt"></i>
                        <span class="nav-label">National Register</span>
                        <span class="fa arrow"></span>
                      </a>
                      <ul class="nav nav-second-level">
                        <li class="@yield('active-nrlist')"><a href="{{ url('dashboard/pusat/rn/list') }}">List NR</a></li>
                        <li class="@yield('active-nrreq')"><a href="{{ url('dashboard/pusat/rn/request') }}">NR Number Request</a></li> 
                      </ul>
                    </li>                    

                    <li>
                        <a href="index-2.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li ><a href="index-2.html">Dashboard v.1</a></li>
                            <li ><a href="dashboard_2.html">Dashboard v.2</a></li>
                            <li ><a href="dashboard_3.html">Dashboard v.3</a></li>
                            <li ><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                        </ul>
                    </li>

                </ul>                
            </div>
            </nav>              
            <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> 
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>         
                    <form role="search" class="navbar-form-custom" action="">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>           
                </div>          
                <ul class="nav navbar-top-links navbar-right">     
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to KADIN Indonesia Panel.</span>
                    </li>                                   
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">                            
                            <i class="fa fa-bell"></i>                                  
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">                            
                            <li>
                                <div class="text-center link-block">
                                    <a href="{{ url('/dashboard/pusat/notif/all') }}">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>                         
                        </ul>
                    </li>   
                    <li>
                        <a href="{{ url('/logout')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>                 
                </ul>

            </nav>
            </div>
            
            <div class="row  border-bottom white-bg dashboard-header">
                @yield('content')
            </div>       
            <br>
            @yield('iframe')

            <div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <strong>Test API REGNUM</strong>
    </div>
    <div class="ibox-content">      
      <div class="row">
        <div class="col-lg-12">
          <div id="wadah">
              
          </div>
          <input type="text" name="rn" id="rn">
          <button onclick="api_post()">API POST</button>
        </div>
      </div>      
    </div>
  </div>
</div>
            </div>
        </div>                                       

        <!-- Modal -->
        <div class="modal fade" id="profileimgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Change Your Profile Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="center-block" align="center">
                            <img id="theimage" src="{{ url('/images') }}/{{ Auth::user()->username}}" alt="your image" class="img-responsive center-block" />
                            &nbsp;
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="imgUploadForm" action="{{ url('image-upload') }}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                <div class="input-group-btn">
                                    <div class="btn btn-primary btn-file">
                                        <i class="glyphicon glyphicon-folder-open"></i>&nbsp;
                                        <span class="hidden-xs">Browse …</span>
                                        <input name="image" type="file" id="imgInp">
                                    </div>
                                    &nbsp;
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>

        <!-- JQuery -->
        <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('resources/assets/js/bootstrap.js') }}"></script>                
        <!-- DataTables -->
        <script src="{{ asset('resources/assets/js/datatables/jquery.dataTables.min.js') }}"></script>  
        <script src="{{ asset('resources/assets/js/datatables/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('resources/assets/js/datatables/dataTables.bootstrap.min.js') }}"></script>
        <!-- Toastr -->
        <script src="{{ asset('resources/assets/js/plugins/toastr/toastr.min.js') }}"></script>

        <!-- Menu & Pace -->        
        <script src="{{ asset('resources/assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Custom and plugin javascript -->
        <script src="{{ asset('resources/assets/js/inspinia.js') }}"></script>
        <script src="{{ asset('resources/assets/js/plugins/pace/pace.min.js') }}"></script>

        <!-- Image cropper -->
        <script src="{{ asset('resources/assets/js/plugins/cropper/cropper.min.js') }}"></script>
        <script type="text/javascript">
            function api_post() 
            {
                var rn = document.getElementById("rn").value;

                $.post("{{ url('api/check_rn/') }}"+"/"+rn, null, function(result){                    
                  var element = document.getElementById("wadah");
                  $("<strong>Validity = "+result.validity+"</strong><br>"+
                    "<strong>RN = "+result.rn+"</strong><br><br>").appendTo(element);

                  console.log(result);
                });
            }
        </script>
    </body>
</html>
