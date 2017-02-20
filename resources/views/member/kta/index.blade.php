@extends('member.app')

@section('head')
    <!-- <link href="{{ asset('resources/assets/css/table_styles.css') }}" rel="stylesheet"> -->
@stop

@section('active-kta')
  active
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
      </div>
      <div class="ibox-content">
        @if ($kta=="")
          <table class="main" width="100%" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td class="alert alert-good text-center">
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
                          <button type="submit" class="btn btn-primary" onclick="requestKta()">
                            <i class="fa fa-paper-plane"></i>
                            &nbsp;
                            Kirim Permintaan KTA
                          </button>
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
        @elseif ($kta=="validated")
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
                  Permintaan KTA anda telah berhasil dikirimkan. Permintaan KTA anda saat ini sedang dalam proses validasi pada Kadin Kabupaten/Kota dimana anda terdaftar. Proses registrasi dan implementasi KTA akan memakan waktu beberapa saat. Kami ucapkan terima kasih atas pengertian dan kesabaran anda.<br>
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
                          <table class="table table-striped table-bordered table-hover dataTables-example" id="kta-table">
                            <thead>
                              <tr>
                                <th>No KTA</th>
                                <th>Requested At</th>
                                <th>Granted At</th>
                                <th>Expired At</th>
                                <th>Options</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>

                          <!-- <div class="form-group">
                            <input type="text" id="thekta" class="form-control" value="{{ $kta }}" style="text-align:center; font-size: 24px; font-family: monospace;" readonly>
                          </div>
                          <br>
                          <div class="text-center">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Copy</button>
                            <button type="button" class="btn btn-success" onclick="printpage()">Print KTA</button>
                          </div>
                          <br><br> -->

                          @if ($exp_show)
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="setting-table">
                            <tr>
                              <td style="background:#f7ecb5;font-weight:bold;text-align:center;">
                                Perhatian !!
                              </td>
                            </tr>
                            <tr>
                              <td align="center">
                                <p>{{ $exp_text1 }}</p>
                                <p>{{ $exp_text2 }} <strong>{{ $exp_text3 }}</strong></p>
                                <p>&nbsp;</p>
                                @if($ext_show)
                                  <button type="button" class="btn btn-danger" onclick="extRequestKta()">Perpanjang KTA</button>
                                @else
                                  <div class="col-lg-4" style="float: none;margin: 0 auto;">
                                    <input type="text" id="thekta" class="form-control" value="KTA Extension Request is Sent" style="text-align:center; font-size: 18px; font-family: monospace;" readonly>
                                  </div>
                                @endif
                              </td>
                            </tr>
                          </table>
                          @endif

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
@stop

@push('scripts')
<script type="text/javascript">
  function printpage() {
    $.ajax({
      url: "{{ url('member/ktaprint') }}",
      type: "post",
      data: {
        _token: "{{ csrf_token() }}"
      }
    }).done(function(data) {
      if (data.success) {
        var win = window.open("{{ url('member/printkta') }}", '_blank');
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Please allow popups for this website');
        }
      } else {
        toastr.error(data.msg);
      }
    });
  }

  function requestKta() {    
    $.ajax({    
      url: "{{ url('member/requestkta/') }}",
      type: "post",
      data: {        
        _token: "{{ csrf_token() }}",        

      }
    }).done(function(data) {                    
      if (data.success) {
        toastr.success(data.msg);
      } else {
        toastr.error(data.msg);
      }

      console.log(data);
      // location.reload();
      setTimeout(location.reload.bind(location), 1000);
         
    });
  }

  $(function() {
    $('#kta-table').DataTable({
      processing: true,
      serverSide: true,          
      bFilter: false, 
      bInfo: false,
      bPaginate: false,
      ajax: "{{ url('member/ajax/kta')}}",
      columns: [
        { "data" : "kta" },
        { "data" : "requested_at" },
        { "data" : "granted_at" },
        { "data" : "expired_at"}
      ],
      "columnDefs": [
        {          
          "render": function ( data, type, row ) {
            return '<button type="button" class="btn btn-white btn-xs">'+
                      '<span class="fa fa-copy fa-fw"></span>'+
                      '&nbsp;&nbsp;Copy'+
                    '</button>'+
                    '<button type="button" class="btn btn-success btn-xs" onclick="printpage()">'+
                      'Print KTA'+
                    '</button>';            
          },
          "targets": 4
        }        
      ]
    });
  });

  function extRequestKta() {    
    $.ajax({    
      url: "{{ url('member/extkta/') }}",
      type: "post",
      data: {        
        _token: "{{ csrf_token() }}"
      }
    }).done(function(data) {                    
      if (data.success) {
        toastr.success(data.msg);
      } else {
        toastr.error(data.msg);
      }

      console.log(data);
      // location.reload();
      setTimeout(location.reload.bind(location), 1000);
         
    });
  }
</script>
@endpush