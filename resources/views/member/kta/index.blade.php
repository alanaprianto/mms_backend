@extends('member.app')

@section('head')
    <!-- <link href="{{ asset('resources/assets/css/table_styles.css') }}" rel="stylesheet"> -->
@stop

@section('sidebar')
  @include('member.kta.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>KTA</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li class="active">
      <strong>KTA</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Your KTA Information</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-wrench"></i>
          </a>
          <ul class="dropdown-menu dropdown-user">
            <li><a href="#">Config option 1</a>
            </li>
            <li><a href="#">Config option 2</a>
            </li>
          </ul>
          <a class="close-link">
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content">       
        @if ($kta=="")            
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
                                            <a href="{{ url('profile/requestkta') }}">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-paper-plane"></i>                                          
                                                    &nbsp;
                                                    Kirim Permintaan KTA
                                                </button>                                                
                                            </a>                                
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
                        <td class="alert alert-good">
                            Member Kadin yang terhormat.<br>              
                            <br>
                            Permintaan KTA anda telah berhasil dikirimkan. Proses registrasi dan implementasi KTA akan memakan waktu beberapa saat. Kami ucapkan terima kasih atas pengertian dan kesabaran anda.<br>
                            <br>
                            Terima Kasih atas kepercayaan anda pada kami.                            
                        </td>
                    </tr>
                </tbody>
            </table>
            @elseif ($kta=="cancelled")
            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="alert alert-good">
                            Permintaan KTA Ditolak !
                        </td>
                    </tr>
                    <tr>
                        <td class="alert alert-good">
                            Member Kadin yang terhormat.<br>              
                            <br>
                            Permintaan KTA anda telah ditolak. Harap perhatikan syarat dan ketentuan anggota kadin. Untuk pengajuan ulang dan bantuan silahkan...<br>
                            <br>
                            Terima Kasih atas kepercayaan anda pada kami.                            
                        </td>
                    </tr>
                </tbody>
            </table>
            @else
            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="alert alert-good">
                            KTA
                        </td>
                    </tr>
                    <tr>
                        <td class="content-wrap">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td class="content-block">
                                            KTA Anda telah Dibuat!.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Permintaan KTA anda telah berhasil digenerate. Berikut adalah nomor KTA Anda
                                            <br><br>
                                            <div class="form-group">                            
                                                <input type="text" id="thekta" class="form-control" value="{{ $kta }}" style="text-align:center; font-size: 24px; font-family: monospace;" readonly>
                                            </div>                       
                                            <br>                                                
                                            <div class="text-center">
                                                <button type="button" class="btn btn-white" data-dismiss="modal">Copy</button>
                                                <button type="button" class="btn btn-success">Print KTA</button>
                                            </div>                                  
                                            <br><br>
                                            Mohon diperhatikan, Nomor KTA bersifat abadi atau nomor yang anda miliki tidak akan digenerate lagi. Bila nomor KTA anda tidak tervalidasi, kemungkinan nomor KTA anda telah habis masa berlaku. Gunakan fitur perpanjangan KTA untuk memperpanjang masa berlaku KTA anda.                                            
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
    </div>
  </div>    
</div>
@stop

@push('scripts')

@endpush