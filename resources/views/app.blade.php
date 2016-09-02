<!DOCTYPE html>
<html>
    <head>
        <title>MMS Backend</title>
           
        <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('resources/assets/css/simple-sidebar.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

        <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
        <script src="{{ asset('resources/assets/js/bootstrap.js') }}"></script>        
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
        
    </body>
</html>
