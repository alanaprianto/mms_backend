<!DOCTYPE html>
<html>
    <head>
        <title>MMS Backend</title>
                   
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Simple Sidebar CSS -->
        <!-- <link href="{{ asset('resources/assets/css/simple-sidebar.css') }}" rel="stylesheet">        -->
        <!-- Datatables CSS -->
        <link href="{{ asset('resources/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">  
        <!-- Toastr -->
        <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/plugins/toastr/toastr.min.css') }}">  
        <!-- Font Awesome -->
        <link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <!-- Gritter -->
        <link href="{{ asset('resources/assets/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

        <link href="{{ asset('resources/assets/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        

        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('resources/img/profile_small.jpg') }}" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">{{ Auth::user()->myrole->name }}<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>                    
                    @yield('sidebar')                            
                </ul>

            </div>
            </nav>              
            <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> 
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>                    
                </div>          
                <ul class="nav navbar-top-links navbar-right">                                        
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  
                                <span class="label label-primary">
                                    @if (count($notifs) > 0)
                                        {{ count($notifs) }}
                                    @endif
                                </span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            @foreach ($notifs->slice(0, 3) as $key=>$notif)
                                <li>
                                    <a href="{{ url('/crud/form/notif') }}/{{ $notif->id }}">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> {{ $notif->value }}
                                            <span class="pull-right text-muted small">{{ $notif->created_at }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                            @endforeach
                            <li>
                                <div class="text-center link-block">
                                    <a href="{{ url('/crud/form/notif/all') }}">
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
        @stack('scripts')
    </body>
</html>
