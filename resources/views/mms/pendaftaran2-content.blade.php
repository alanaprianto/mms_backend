@extends('mms.appregister')

@section('memberactive')
  <?php echo 'active';?>
@stop

@section('content')

<div class="container">
	<div class="row features-block">
		<!--<div class="col-lg-12 features-text wow fadeInLeft">-->
		<div class="col-lg-12 features-text wow fadeInLeft">
			<!-- <strong>REGISTER MEMBER KEANGGOTAAN KADIN INDONESIA</strong><br/> -->
			<strong>REGISTER ANGGOTA LUAR BIASA KADIN INDONESIA</strong><br/>
			<small>Silahkan isi data pada form dibawah ini !</small><br/><br/>
			@include('errors.error_list')

			{!! Form::open(['action' => ['PendaftaranController@store2'], 'id' => 'wadah', 'enctype' => 'multipart/form-data']) !!}
				<input type="hidden" name="alb" value="true">
			{!! Form::close() !!}
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
</section>
<!--
<div class="wrapper wrapper-content">
	<div class="row animated fadeInRight">
    	<div class="col-md-12">
    		<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h1>Form Pendaftaran</h1>
				</div>
				<div>
					<div class="ibox-content profile-content">
						@include('errors.error_list')

						{!! Form::open(['action' => ['PendaftaranController@store'], 'id' => 'wadah']) !!}

						{!! Form::close() !!}
          </div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
@stop

@push('scripts')
	{{ $alb = true }}
	@include('dynamic_form_script')
	<script type="text/javascript">
		$('#kbliModal').on('show.bs.modal', function (event) {  
          var button = $(event.relatedTarget) // Button that triggered the modal
          id = button.data('id');            
          
          setKbli("pilKbli1", "1", "0");
        });

        function setKbli(id, type, parent) {
          // if(type==1) {
          //   frmTemp.pilKbli2.value='=== KBLI 2 ===';
          //   frmTemp.pilKbli3.value='=== KBLI 3 ===';
          //   frmTemp.pilKbli4.value='=== KBLI 4 ===';
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // } else if(type==2) {
          //   frmTemp.pilKbli3.value='=== KBLI 3 ===';
          //   frmTemp.pilKbli4.value='=== KBLI 4 ===';
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // } else if(type==3) {
          //   frmTemp.pilKbli4.value='=== KBLI 4 ===';
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // } else if(type==4) {
          //   frmTemp.pilKbli5.value='=== KBLI 5 ===';
          // }

          $.ajax({
            url: "{{ url('kbli/list') }}",
            type: "post",
            data: {
              _token: "{{ csrf_token() }}",
              type: type,
              parent: parent,
            }
          }).done(function(datas) {
            clearElement(id);               
            var element = document.getElementById(id);
            for (u = 0; u < datas.length; u++) {
              $(  "<option value='"+datas[u].id+"'>"+
                    datas[u].id+
                    " # "+
                    datas[u].limited_name+
                  "</option>")
              .appendTo(element);
            }
          });

          setKblitxt(parent);
        }        

        function setKblitxt(txt) {
          $("#thekbli").val(txt);
        }

        $('#btnKbli').on('click', function (event) {
          $('#kbliModal').modal('hide');

          var kbli = $("#thekbli").val();                    
          $('input[name='+id+']').val(kbli);
        });
	</script>
@endpush
