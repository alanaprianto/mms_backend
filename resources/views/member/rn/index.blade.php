@extends('member.app')

@section('head')
    <!-- <link href="{{ asset('resources/assets/css/table_styles.css') }}" rel="stylesheet"> -->

@stop

@section('sidebar')
  @include('member.rn.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>National Registration</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li class="active">
      <strong>National Registration</strong>
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
        <h5>Your National Registration Information</h5>
      </div>
      <div class="ibox-content">
        @if ($rn=="")
          <table class="main" width="100%" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td class="alert alert-good">
                  Nomor Registrasi Nasional Belum Dibuat!
                </td>
              </tr>
              <tr>
                <td class="alert alert-good">
                  Member Kadin yang terhormat.<br>              
                  <br>
                  Untuk saat ini, permintaan nomor registrasi nasional anda belum bisa dibuat. Berdasarkan ketentuan, anda wajib terlebih dahulu memperoleh nomor KTA (Kartu Tanda Anggota) sebelum nomor registrasi nasional dapat dibuat. Periksakan permohonan nomor KTA anda pada halaman depan sistem Member Manajemen Kadin untuk melacak status permohonan nomor KTA anda.<br>
                  Kami ucapkan terima kasih atas pengertian dan kesabaran anda.<br>
                  <br>
                  Terima Kasih atas kepercayaan anda pada kami.                            
                </td>
              </tr>
            </tbody>
          </table>
        @elseif ($rn=="requested")
          <table class="main" width="100%" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td class="alert alert-good">
                  Permintaan Nomor Registrasi Nasional Telah Terkirim !
                </td>
              </tr>
              <tr>
                <td class="alert alert-good">
                  Member Kadin yang terhormat.<br>              
                  <br>
                  Permintaan Nomor Registrasi Nasional anda telah berhasil dikirimkan. Proses registrasi dan implementasi Nomor Registrasi Nasional akan memakan waktu beberapa saat. Kami ucapkan terima kasih atas pengertian dan kesabaran anda.<br>
                  <br>
                  Terima Kasih atas kepercayaan anda pada kami.                            
                </td>
              </tr>
            </tbody>
          </table>                 
        @elseif ($rn=="cancelled")
          <table class="main" width="100%" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td class="alert alert-good">
                  Permintaan Nomor Registrasi Nasional Ditolak !
                </td>
              </tr>
              <tr>
                <td class="alert alert-good">
                  Member Kadin yang terhormat.<br>
                  <br>
                  Permintaan Nomor Registrasi Nasional anda telah ditolak. Harap perhatikan syarat dan ketentuan anggota kadin. Untuk pengajuan ulang dan bantuan silahkan...<br>
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
                  Nomor Registrasi Nasional
                </td>
              </tr>
              <tr>
                <td class="content-wrap">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td class="content-block">
                          Nomor Registrasi Nasional Anda telah Dibuat!.
                        </td>
                      </tr>
                      <tr>
                        <td class="content-block">
                          Permintaan Nomor Registrasi Nasional anda telah berhasil digenerate. Berikut adalah nomor Nomor Registrasi Nasional Anda
                          <br><br>
                          <div class="form-group">
                            <input type="text" id="thern" class="form-control" value="{{ $rn }}" style="text-align:center; font-size: 24px; font-family: monospace;" readonly>
                          </div>                          
                          <br><br>
                          Mohon diperhatikan, Nomor Registrasi Nasional bersifat abadi atau nomor yang anda miliki tidak akan digenerate lagi. Setelah anda memiliki Nomor Registrasi Nasional Kadin, maka anda telah secara sah diakui sebagai anggota Kamar Dagang Indonesia.
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
@stop