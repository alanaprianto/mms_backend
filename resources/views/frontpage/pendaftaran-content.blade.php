@extends('frontpage.appregister')

@section('memberactive')
  <?php echo 'active';?>
@stop

@section('content')
<div class="container">
	<div class="row features-block">
		<!--<div class="col-lg-12 features-text wow fadeInLeft">-->
		<div class="col-lg-12 features-text wow fadeInLeft">
			<!-- <strong>REGISTER MEMBER KEANGGOTAAN KADIN INDONESIA</strong><br/> -->
			<strong>REGISTER ANGGOTA BIASA KADIN INDONESIA</strong><br/>
			<small>Silahkan isi data pada form dibawah ini !</small><br/><br/>
			@include('errors.error_list')

			{!! Form::open(['action' => ['PendaftaranController@store'], 'id' => 'wadah']) !!}
				<input type="hidden" name="alb" value="false">
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop

@push('scripts')
	{{ $alb = false }}
	@include('scripts.dynamic_form_script')
@endpush
