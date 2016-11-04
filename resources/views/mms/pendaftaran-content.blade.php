@extends('mms.app')

@section('content')
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
@stop

@push('scripts')
	@include('dynamic_form_script')
@endpush