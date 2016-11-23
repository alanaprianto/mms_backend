<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Bootstrap File Input Demo - © Kartik</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Kraaje Fileinputmin CSS -->
    <link href="{{ asset('resources/assets/css/fileinput.min.css') }}" rel="stylesheet">
  </head>
  <body>
    <style type="text/css">
      .kadin-border1 {
        border-style: solid;
        border-width: 71px 73px 72px 71px;
        -moz-border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 71 73 72 71 round repeat;
        -webkit-border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 71 73 72 71 round repeat;
        -o-border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 71 73 72 71 round repeat;
        border-image: url("{{ url('resources/assets/images/kadin-border.gif') }}") 71 73 72 71 fill round repeat;
      }

      .kadin-border {
        border-style: solid;
        border-width: 37px 41px 44px 37px;
        -moz-border-image: "{{ url('resources/assets/images/kadin-border2.png') }}" 37 41 44 37 round;
        -webkit-border-image: "{{ url('resources/assets/images/kadin-border2.png') }}" 37 41 44 37 round;
        -o-border-image: "{{ url('resources/assets/images/kadin-border2.png') }}" 37 41 44 37 round;
        border-image: "{{ url('resources/assets/images/kadin-border2.png') }}" 37 41 44 37 fill round;
      }

      .col-centered{
        float: none;
        margin: 0 auto;
      }

      .test{
        height: 4cm;
        width: 3cm;
        border-style: solid;
        border-width: 3px;    
        margin-left: auto;
        margin-right: auto;
      }

      .center-in-parent {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
      }
    </style>
    <div id="print-this" class="kadin-border1">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-5 col-centered">
              <table>
                <tr>
                  <td>
                    <img class="img-responsive" src="{{ url('resources/img/icon144-128x128-10.png') }}">
                  </td>
                  <td>&nbsp;&nbsp;</td>
                  <td align="center" style="font-family:arial;">
                    <b style="font-size:19px;">KAMAR DAGANG DAN INDUSTRI</b><br>
                    <i style="font-size:17px;">Chamber of Commerce and Industry</i><br>
                    <b style="font-size:19px;">KARTU TANDA ANGGOTA BIASA</b><br>
                    <i style="font-size:17px;">Certificate of Ordinary Member</i>
                  </td>
                </tr>
              </table>
            </div>            
          </div>          
          <div class="row" style="padding-top:30px;">
            <div class="col-md-4 text-center">
              <b style="font-size:15px;">Nomor Anggota</b><br>
              <i style="font-size:14px;">Membership Number</i><br><br>
              <b style="font-size:15px;">20204-16000004</b>
            </div>
            <div class="col-md-4 text-center">
              <b style="font-size:15px;">Berlaku Sampai Dengan</b><br>
              <i style="font-size:14px;">Valid Until</i><br><br>
              <b style="font-size:15px;">20204-16000004</b>
            </div>
            <div class="col-md-4 text-center">
              <b style="font-size:15px;">Nomor Registrasi Nasional</b><br>
              <i style="font-size:14px;">National Registered Number</i><br><br>
              <b style="font-size:15px;">20204-16000004</b>
            </div> 
          </div>
          <div class="row">
            <div class="col-md-12" style="padding-top:20px;">
              <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                  <div class="ibox-content">
                    <div class="row">
                      <div class="col-md-12">                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <table width="100%" style="margin-left:30px;">
                          <tr>
                            <td width="60%">
                              <b style="font-size:15px;">NAMA PERUSAHAAN</b><br>
                              <i style="font-size:14px;">Name of Company</i>
                            </td>
                            <td width="5%">:</td>
                            <td style="font-size:14px;">VERTICA LABORA SINERGI, PT</td>
                          </tr>                              
                          <tr>
                            <td>
                              <b style="font-size:15px;">PEMIMPIN PERUSAHAAN</b><br>
                              <i style="font-size:14px;">Person in Charge</i>
                            </td>
                            <td>:</td>
                            <td style="font-size:14px;">ARIEF BASYARI</td>
                          </tr>
                          <tr>
                            <td>
                              <b style="font-size:15px;">ALAMAT PERUSAHAAN</b><br>
                              <i style="font-size:14px;">Company's Address</i>
                            </td>
                            <td>:</td>
                            <td style="font-size:14px;">JL. RADEN INTEN II BUARAN KLENDER BLOK B NO. 210, RT.001 RW.014
                              KEL. KLENDER, KEC. DUREN SAWIT
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <b style="font-size:15px;">BIDANG USAHA</b><br>
                              <i style="font-size:14px;">Line of Bussiness</i>
                            </td>
                            <td>:</td>
                            <td style="font-size:14px;">Jasa, Perdagangan</td>
                          </tr>
                          <tr>
                            <td>
                              <b style="font-size:15px;">SURAT IZIN USAHA</b><br>
                              <i style="font-size:14px;">Bussiness Permit Number</i>
                            </td>
                            <td>:</td>
                            <td style="font-size:14px;">198/24.1PM/31.75/-1.824.27/E/2016</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-6">
                        <table width="100%" style="margin-left:30px;">
                          <tr>
                            <td width="60%">
                              <b style="font-size:15px;">JABATAN</b><br>
                              <i style="font-size:14px;">Position</i>
                            </td>
                            <td width="5%">:</td>
                            <td style="font-size:14px;">Direktur Utama</td>
                          </tr>
                          <tr>
                            <td>
                              <b style="font-size:15px;">KODE POS</b><br>
                              <i style="font-size:14px;">Zip Code</i>
                            </td>
                            <td>:</td>
                            <td style="font-size:14px;">13740</td>
                          </tr>
                        </table>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>            
          </div>
          <div class="row">
            <div class="col-md-6">
              <table width="100%" style="margin-left:30px;">
                <tr>
                  <td width="60%">
                    <b style="font-size:15px;">KUALIFIKASI PERUSAHAAN</b><br>
                    <i style="font-size:14px;">Company's Qualification</i>
                  </td>
                  <td width="5%">:</td>
                  <td style="font-size:14px;">Perusahaan Kecil 1</td>
                </tr>
              </table>              
            </div>
            <div class="col-md-6">
              <table width="100%" style="margin-left:30px;">
                <tr>
                  <td width="60%">
                    <b style="font-size:15px;">NPWP PERUSAHAAN</b><br>
                    <i style="font-size:14px;">Tax Registration Number</i>
                  </td>
                  <td width="5%">:</td>
                  <td style="font-size:14px;">02.658.111.6-952.000</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row" style="padding-top:10px;">
            <div class="col-md-6 col-centered" align="center">
              <b style="font-size:15px;">ADALAH ANGGOTA BIASA KAMAR DAGANG DAN INDUSTRI (KADIN)</b><br>
              <i style="font-size:14px;">is an Ordinary Member of Chamber of Commerce and Industry (Kadin)</i>
            </div>            
          </div>
          <div class="row" style="padding-top:10px;">
            <div class="col-md-6">
              <table width="100%" style="margin-left:30px;font-size:12px;">
                <tr>
                  <td width="60%">
                    <strong>Kabupaten/Kota</strong><br>
                    <i>District/Municipality</i>
                  </td>
                  <td width="5%">:</td>
                  <td>KEEROM</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table width="100%" style="margin-left:30px;font-size:12px;">
                <tr>
                  <td width="60%">
                    <strong>Provinsi</strong><br>
                    <i>Province</i>
                  </td>
                  <td width="5%">:</td>
                  <td>PAPUA</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row" style="padding-top:10px;">
            <div class="col-md-3" style="padding-top:25px;">
              <div class="test">
                <div class="center-in-parent" style="font-size:10px;" align="center">
                  Pasfoto<br>
                  Pemimpin<br>
                  Perusahaan<br>
                  <br>
                  3 x 4
                </div>                
              </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-4" align="center">
                  <b style="font-size:13px;">Dewan Pengurus Kadin Kabupaten/Kota</b><br>
                  <i style="font-size:12px;">Board of Directors, Kadin District/Municipality</i>
                  <br><br><br><br><br>
                  <b style="font-size:13px;">Romi Lesmana</b><br>
                  <hr style="border-top: dotted 1px;margin: 0 0;" />
                  <i style="font-size:12px;">Ketua / Chairman</i>
                </div>
                <div class="col-md-4" align="center">
                  <b style="font-size:13px;">Dewan Pengurus Kadin Propinsi</b><br>
                  <i style="font-size:12px;">Board of Directors, Kadin Province</i>
                  <br><br><br><br><br>
                  <b style="font-size:13px;">Ir. H. Eddy Kuntadi</b><br>
                  <hr style="border-top: dotted 1px;margin: 0 0;" />
                  <i style="font-size:12px;">Ketua Umum / Chairman</i>
                </div>
                <div class="col-md-4" align="center">
                  <b style="font-size:13px;">Dewan Pengurus Kadin Indonesia</b><br>
                  <i style="font-size:12px;">Board of Directors, Kadin Indonesia</i>
                  <br><br><br><br><br>
                  <b style="font-size:13px;">Rosan P. Roeslani</b><br>                  
                  <hr style="border-top: dotted 1px;margin: 0 0;" />
                  <i style="font-size:12px;">Ketua Umum / President</i>
                </div>
              </div>
              <div class="col-md-12" align="center" style="padding-top:20px;">
                <b style="font-size:12px;">KARTU TANDA ANGGOTA INI TIDAK SAH JIKA TIDAK ADA DATA REGISTRASINYA DI: www.anggotakadin.com</b><br>
                <i style="font-size:11px;">This Certificate is not valid if there is no registration data at: www.anggotakadin.com</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="container">      
      <div class="row">        
        <div class="col-md-2 col-md-offset-5">
          <img id="blah" src="#" alt="your image" class="img-responsive center-block" />
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

          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
          </div>
          <img src="{{ url('images')}}/{{ Session::get('path') }}">
          @endif

          <form action="{{ url('image-upload') }}" enctype="multipart/form-data" method="POST">
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
    </div>         -->

    <!-- JQuery -->
    <!-- <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>    
    <script type="text/javascript">
      function readURL(input) {

          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#imgInp").change(function(){
          readURL(this);
      });
    </script> -->
  </body>
</html>