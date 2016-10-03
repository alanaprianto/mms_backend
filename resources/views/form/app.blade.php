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

        <link href="{{ asset('resources/assets/css/plugins/cropper/cropper.min.css') }}" rel="stylesheet">
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
                                    <img alt="image" class="img-circle" src="{{ asset('resources/img/') }}/{{ Auth::user()->username}}.jpg" height="48" width="48" />
                                </span>
                            </a>                            
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
                                @if (count($notifs) > 0)
                                    <span class="label label-primary">
                                        {{ count($notifs) }}                                    
                                    </span>
                                @endif
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            @foreach ($notifs->slice(0, 3) as $key=>$notif)
                                <li>
                                    <a href="{{ url('/crud/form/notif') }}/{{ $notif->id }}">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> {{ $notif->value }}
                                            <span class="pull-right text-muted small">{{ $notif->crt_human }}</span>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="image-crop">
                            <img src="{{ asset('resources/img/') }}/{{ Auth::user()->username}}.jpg">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Preview image</h4>
                        <div class="img-preview img-preview-sm"></div>
                        <br>
                        <div class="btn-group">
                            <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                <input type="file" accept="image/*" name="file" id="inputImage" class="hide">
                                Upload new image
                            </label>
                            <label title="Donload image" id="download" class="btn btn-primary">Save</label>
                        </div>   
                        <br><br>
                        <h4>Other method</h4>                                
                        <div class="btn-group">
                            <button class="btn btn-white" id="zoomIn" type="button">Zoom In</button>
                            <button class="btn btn-white" id="zoomOut" type="button">Zoom Out</button>
                            <br>
                            <button class="btn btn-white" id="rotateLeft" type="button">Rotate Left</button>
                            <button class="btn btn-white" id="rotateRight" type="button">Rotate Right</button>                         
                        </div>
                    </div>                             
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
            $(document).ready(function(){
                var $image = $(".image-crop > img")
                $($image).cropper({
                    aspectRatio: 1.618,
                    preview: ".img-preview",
                    done: function(data) {
                        // Output the result data for cropping image.
                    }
                });

                var $inputImage = $("#inputImage");
                if (window.FileReader) {
                    $inputImage.change(function() {
                        var fileReader = new FileReader(),
                                files = this.files,
                                file;

                        if (!files.length) {
                            return;
                        }

                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            fileReader.readAsDataURL(file);
                            fileReader.onload = function () {
                                $inputImage.val("");
                                $image.cropper("reset", true).cropper("replace", this.result);
                            };
                        } else {
                            showMessage("Please choose an image file.");
                        }
                    });
                } else {
                    $inputImage.addClass("hide");
                }

                $("#download").click(function() {
                    window.open($image.cropper("getDataURL"));
                });       

                $("#zoomIn").click(function() {
                    $image.cropper("zoom", 0.1);
                });

                $("#zoomOut").click(function() {
                    $image.cropper("zoom", -0.1);
                });

                $("#rotateLeft").click(function() {
                    $image.cropper("rotate", 45);
                });

                $("#rotateRight").click(function() {
                    $image.cropper("rotate", -45);
                });

                $("#setDrag").click(function() {
                    $image.cropper("setDragMode", "crop");
                });         
            });
        </script>
        @stack('scripts')
    </body>
</html>
