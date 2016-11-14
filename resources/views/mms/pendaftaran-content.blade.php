@extends('mms.appregister')

@section('memberactive')
  <?php echo 'active';?>
@stop

@section('content')

<div class="container">
	<div class="row features-block">
		<!--<div class="col-lg-12 features-text wow fadeInLeft">-->
		<div class="col-lg-12 features-text wow fadeInLeft">
			<strong>REGISTER MEMBER KEANGGOTAAN KADIN INDONESIA</strong><br/>
			<small>Silahkan isi data pada form dibawah ini !</small><br/><br/>
			@include('errors.error_list')

			{!! Form::open(['action' => ['PendaftaranController@store'], 'id' => 'wadah']) !!}

			{!! Form::close() !!}
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
	@include('dynamic_form_script')
@endpush
