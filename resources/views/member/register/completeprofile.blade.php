@extends('common.app')

@section('active-comprof')
  active
@stop

@section('content')
<div id="breadcrumbs-bar" class="col-lg-10">
  <h2>Form Pelengkapan Profile</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li>
      <a>Company Profile</a>
    </li>
    <li class="active">
      <strong>{{ $fqg->name }}</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <strong>Update Profile Information</strong><br/>
      <small>Silahkan melengkapi form dibawah ini !</small>
    </div>
    <div class="ibox-content">
      @if ($fqg->id==22)
        Ketentuan Gambar:<br/>
        - Max Besar 2Mb<br/>
        - Type File Berupa: jpg/jpeg/png/gif/svg<br/><br/>
      @endif

      @include('errors.error_list')

      <form method="POST" action="{{ url('registerii') }}/{{ $fqg->id}}" accept-charset="UTF-8" id="wadah" enctype="multipart/form-data">
        <input name="_token" value="{{ csrf_token() }}" type="hidden">                                
      </form>                   
    </div>
  </div>
</div>

<!-- KBLI Modal -->
<div class="modal inmodal" id="kbliModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>        
        <h4 class="modal-title">Pencarian KBLI</h4>    
      </div>
      <div class="modal-body">
        <p>Silakan memilih KBLI yang tersedia di bawah ini.</p>
        <div class="">
          <form id="frmTemp" method="post" action="">            
            <select id="pilKbli1" class="form-control" onchange="setKbli('pilKbli2', '2', this.value);">
              <!-- <option value="" selected="">=== KBLI 1 ===</option>
              <option value="A">A # PERTANIAN, KEHUTANAN DAN PERIKANAN</option>
              <option value="B">B # PERTAMBANGAN DAN PENGGALIAN</option>
              <option value="C">C # INDUSTRI PENGOLAHAN</option>
              <option value="D">D # PENGADAAN LISTRIK, GAS, UAP/AIR PANAS DAN UDARA DINGIN</option>
              <option value="E">E # PENGADAAN AIR, PENGELOLAAN SAMPAH DAN DAUR ULANG,...</option>
              <option value="F">F # KONSTRUKSI</option>
              <option value="G">G # PERDAGANGAN BESAR DAN ECERAN; REPARASI DAN PERAWATAN MOBIL...</option>
              <option value="H">H # TRANSPORTASI DAN PERGUDANGAN</option>
              <option value="I">I # PENYEDIAAN AKOMODASI DAN PENYEDIAAN MAKAN MINUM</option>
              <option value="J">J # INFORMASI DAN KOMUNIKASI</option>
              <option value="K">K # JASA KEUANGAN DAN ASURANSI</option>
              <option value="L">L # REAL ESTAT</option>
              <option value="M">M # JASA PROFESIONAL, ILMIAH DAN TEKNIS</option>
              <option value="N">N # JASA PERSEWAAN DAN SEWA GUNA USAHA TANPA HAK OPSI,...</option>
              <option value="O">O # ADMINISTRASI PEMERINTAHAN, PERTAHANAN DAN JAMINAN SOSIAL...</option>
              <option value="P">P # JASA PENDIDIKAN</option>
              <option value="Q">Q # JASA KESEHATAN DAN KEGIATAN SOSIAL</option>
              <option value="R">R # KESENIAN, HIBURAN DAN REKREASI</option>
              <option value="S">S # KEGIATAN JASA LAINNYA</option>
              <option value="T">T # JASA PERORANGAN YANG MELAYANI RUMAH TANGGA; KEGIATAN YANG...</option>
              <option value="U">U # KEGIATAN BADAN INTERNASIONAL DAN BADAN EKSTRA INTERNASIONAL...</option> -->
            </select>            
            <br>
            <select id="pilKbli2" class="form-control" onchange="setKbli('pilKbli3', '3', this.value);">
              <option value='' selected>=== KBLI 2 ===</option>
            </select>
            <br>
            <select id="pilKbli3" class="form-control" onchange="setKbli('pilKbli4', '4', this.value);">
              <option value='' selected>=== KBLI 3 ===</option>
            </select>
            <br>
            <select id="pilKbli4" class="form-control" onchange="setKbli('pilKbli5', '5', this.value);">
              <option value='' selected>=== KBLI 4 ===</option>
            </select>
            <br>
            <select id="pilKbli5" class="form-control" onchange="setKblitxt(this.value);">
              <option value='' selected>=== KBLI 5 ===</option>
            </select>            
            <br><br>
            <div class="form-group">
              <label for="thkbli" align="center">Kode KBLI</label><br>
              <input type="text" id="thekbli" class="form-control" value="ASDAD" style="text-align:center;font-size: 24px; font-family: monospace;color:#0000ff; background-color:#eeeeee;" readonly>
            </div>
            <br><br>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
        <button id="btnKbli" type="button" class="btn btn-primary">Pilih</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
    @include('scripts.setkbli_script')
	<script type="text/javascript">
	    var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
        var answers = JSON.parse("{{ $fresults }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
	</script>
    {{ $alb = false }}
    @include('scripts.dynamic_form_script1')
@endpush