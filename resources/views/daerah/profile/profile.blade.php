@extends('daerah.app')

@section('sidebar')
  @include('daerah.sidebar-plain')
@stop

@section('content')
	<h1> Profile </h1>	
@stop

@section('iframe')
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-md-4">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Profile Detail</h5>
        </div>
        <div>
          <div class="ibox-content col-centered">
            <img alt="image" class="img-responsive" src="{{ url('/images') }}/{{ Auth::user()->username}}.jpg">
          </div>
          <div class="ibox-content profile-content">
            <h4><strong>{{ Auth::user()->username }}</strong></h4>
            <p><i class="fa fa-map-marker"></i> {{ Auth::user()->territory_name }}</p>
            <br>
            <div class="list-group" width="100%">
              <a id="gr-overview" href="#" class="list-group-item list-group-item-info">Overview</a>
              <a id="gr-profil" href="#" class="list-group-item list-group-item-info">Profile</a>
              <a id="gr-kta" href="#" class="list-group-item list-group-item-info">KTA</a>              
            </div>                                
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="border-bottom white-bg dashboard-header">
        <div id="judul">
        </div>
        <div id="wadah">
        </div>
      </div>
    </div>
  </div>
</div>

        <div id="overview" class="hidden">
            <h5>Your Account Information ({{ $completed }}/{{ $required }})</h5>

            <div class="progress progress-striped active">
                <div style="width: {{ $percentage}}%" aria-valuemax="{{ $required }}" aria-valuemin="0" aria-valuenow="{{ $completed }}" role="progressbar" class="progress-bar progress-bar-success">
                    <!-- <span class="sr-only">0% Complete (success)</span> -->
                </div>
            </div>

            @unless ($percentage == 100 || $percentage == 0)                
                <a href="{{ url('registerii') }}" class="btn btn-warning btn-block">Complete your account Information</a>
                <br>
            @endunless
                                    
            <table class="table" id="profile-table" width=100%>                                                                   
            </table>
        </div>

        <div id="profile" class="hidden">            
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pendaftaran</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>                        
                    </div>
                </div>
                <div class="ibox-content" style="display: block;">
                    <div>
                        <table class="table" id="profile-table" width=100%>                                                     
                        </table>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Tahap 2</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>                        
                    </div>
                </div>
                <div class="ibox-content" style="display: block;">
                    <div>
                        <table class="table" id="tahap2-table" width=100%>                                                     
                        </table>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Tahap 3</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>                        
                    </div>
                </div>
                <div class="ibox-content" style="display: block;">
                    <div>
                        <table class="table" id="tahap3-table" width=100%>                                                     
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="kta" class="hidden">     
            @if ($kta=="0")            
            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="alert alert-good">
                            Silahkan klik tombol dibawah untuk mengirimkan permintaan Nomor KTA!
                        </td>
                    </tr>
                    <tr>
                        <td class="content-wrap">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>                                    
                                    <tr>
                                        <td class="content-block" align="center">
                                            <br>
                                            <br>
                                            <br>
                                            <a href="{{ url('profile/requestkta') }}" class="btn-primary"><i class="fa fa-paper-plane"></i> &nbsp; Kirim Permintaan KTA</a>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            @elseif ($kta=="requested")
            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="alert alert-good">
                            Permintaan KTA Telah Terkirim !
                        </td>
                    </tr>
                    <tr>
                        <td class="content-wrap">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td class="content-block">
                                            Member Kadin yang terhormat.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Permintaan KTA anda telah berhasil dikirimkan. Proses registrasi dan implementasi KTA akan memakan waktu beberapa saat. Kami ucapkan terima kasih atas pengertian dan kesabaran anda.
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="content-block">
                                            Terima Kasih atas kepercayaan anda pada kami.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif   
        </div>
@stop

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('resources/assets/js/datatables/jquery.dataTables.min.js') }}"></script>  
<script src="{{ asset('resources/assets/js/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('resources/assets/js/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/inspinia.js') }}"></script>

<script type="text/javascript">        
    $(window).on('load', function(e) {                                   
        console.log($(window).contentWindow.document.body.scrollHeight);
    });

    $(document).ready(function(){
        document.getElementById("gr-overview").click(); // Simulates button click     
    });

    $('#gr-profil').on('click', function (event) {
        var element = document.getElementById("wadah");
        var profile = document.getElementById("profile");
        var title = document.getElementById("judul");

        title.innerHTML = "<h3>Profile</h3><br>";
        title.style.visibility='visible';
        element.innerHTML = profile.innerHTML;
        loadTable("profile-table", "{{ url('profile/indexAjax/')}}"+"/"+"{{ Auth::user()->id }}");
        loadTable("tahap2-table", "{{ url('profile/tahapiiAjax/')}}"+"/"+"{{ Auth::user()->id }}");
        loadTable("tahap3-table", "{{ url('profile/tahapiiiAjax/')}}"+"/"+"{{ Auth::user()->id }}");
    });

    $('#gr-kta').on('click', function (event) {
        var element = document.getElementById("wadah");
        var kta = document.getElementById("kta");
        var title = document.getElementById("judul");        

        title.style.visibility='hidden'
        element.innerHTML = kta.innerHTML;

    });

    $('#gr-overview').on('click', function (event) {
        var element = document.getElementById("wadah");
        var overview = document.getElementById("overview");
        var title = document.getElementById("judul");

        title.innerHTML = "<h3>Overview</h3><br>";
        title.style.visibility='visible';
        element.innerHTML = overview.innerHTML;            

        loadTable("profile-table", "{{ url('profile/indexAjax/')}}"+"/"+"{{ Auth::user()->id }}");
    });    

    function loadTable(id, url) {
        $('#'+id).DataTable({
            processing: true,
            serverSide: true,
            sDom: 'rt',
            bSort: false,
            ajax: url,
            columns: [       
              { "data" : "question" },          
              { "data" : "answer" },                  
            ],
          });
    }    
</script>
@endpush