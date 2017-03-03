@extends('frontpage.appregister')

@section('memberactive')
  <?php echo 'active';?>
@stop

@section('content')
<div class="container">
  <div class="row features-block">
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

<!-- Insert Modal -->
<div class="modal inmodal" id="insertModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content animated bounceInRight">
	  <div class="modal-header">
	  	<button type="button" class="close" data-dismiss="modal">
		  <span aria-hidden="true">&times;</span>
		  <span class="sr-only">Close</span>
		</button>
		<h4 class="modal-title">Pernyataan</h4>
	  </div>
	  <div class="modal-body">
	 	<p>Bersama ini kami menyatakan pemahaman kami bahwa:</p>
		<p align="justify">
		  <ul>
 		    <li align="justify">Kamar Dagang dan Industri (KADIN) merupakan satu-satunya organisasi sebagai wadah pengusaha Indonesia dan bergerak dalam bidang perekonomian yang ditetapkan berdasarkan Undang-Undang Republik Indonesia Nomor 1 Tahun 1987, dan Keputusan Presiden Republik Indonesia Nomor 17 Tahun 2010 tentang persetujuan perubahan anggaran dasar dan anggaran rumah tangga KADIN.</li>
		    <li align="justify">Dengan Undang-Undang tersebut ditetapkan adanya satu Kamar dagang dan Industri yang merupakan wadah bagi pengusaha Indonesia, baik yang bergabung maupun yang tidak bergabung dalam organisasi pengusaha dan/atau organisasi perusahaan</li>
		    <li align="justify">Kamar Dagang Industri bersifat mandiri, bukan organisasi pemerintah dan bukan organisasi politik serta dalam kegiatannya tidak mencari keuntungan.</li>
		    <li align="justify">Setiap pengusaha Indonesia serta organisasi perusahaan dan organisasi pengusaha harus menjadi anggota KADIN dengan mendaftar pada KADIN</li>
		  </ul>
		</p>
		<p align="justify">Berkenaan dengan hal tersebut, semua data dan informasi yang telah kami sampaikan mengenai perusahaan/organisasi kami dalam rangka permohonan untuk menjadi anggota KADIN adalah lengkap, mutakhir/terbaru dan benar. Apabila diperlukan, kami siap untuk menyampaikan dokumen-dokumen pendukung atas keterangan yang telah kami sampaikan dan siap menerima akibat sesuai pedoman organisasi yang berlaku dari penyampaian keterangan/informasi yang salah.</p>
		<div class="checkbox form-control bg-warning">
		  <label>
			<input type="checkbox" id="agree" value="1">
			Saya setuju dengan pernyataan tersebut.
		  </label>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		<button id="btnsubmit" type="button" class="btn btn-primary" disabled>Daftar</button>
	  </div>
	</div>
  </div>
</div>
@stop

@push('scripts')
	{{ $alb = true }}
	@include('scripts.dynamic_form_script')
	@include('scripts.setkbli_script')

	<script>
        $('#insertModal').on('show.bs.modal', function (event) {
            document.getElementById("agree").checked = false;
        });
	</script>
@endpush
