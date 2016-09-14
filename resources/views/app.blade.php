<!DOCTYPE html>
<html>
    <head>
        <title>MMS Backend</title>
           
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Simple Sidebar CSS -->
        <link href="{{ asset('resources/assets/css/simple-sidebar.css') }}" rel="stylesheet">            
        <!-- Datatables CSS -->
        <link href="{{ asset('resources/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">  
        <!-- Toastr -->
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">   
    </head>
    <body>
        <div id="wrapper">    
            <div id="sidebar-wrapper"> 
                <div class="sidebar-nav">
                    <ul class="sidebar-brand">
                        <a href=""> 
                            MMS Form CRUD
                        </a>
                    </ul>               
                    {!! $MyNavBar->asUl() !!}
                    <!-- array('class' => 'sidebar-nav') -->
                </div>                
            </div>

            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
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
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
        @stack('scripts')
    </body>
</html>
