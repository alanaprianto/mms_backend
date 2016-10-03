@extends('mms.app')

@section('content')	

<section class="mbr-section" id="msg-box8-0" style="background-color: #ffffff; padding-top: 160px; padding-bottom: 120px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: #ffffff;">

    </div>
    <div class="container">
        <div class="well" style="margin-top: -100px; margin-left: 100px; margin-right:100px; margin-bottom:-80px;">
			<h2>Edit Profile</h2>
			<br>

			@include('errors.error_list')

			{!! Form::open(['action' => ['LoginController@login'], 'id' => 'wadah']) !!}			
				<div class="form-group">
					{!! Form::label('name', 'Name :') !!}
					{!! Form::text('username', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('alamat', 'Address :') !!}
					{!! Form::password('password', ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('field', 'Example :') !!}
					{!! Form::text('username', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('fieldd', 'Example :') !!}
					{!! Form::password('password', ['class' => 'form-control']) !!}
				</div>												

				<div class="form-group">
					{!! Form::submit('Update!', ['class' => 'btn btn-primary form-control']) !!}
				</div>		
				
			{!! Form::close() !!}
		</div>
    </div>

</section>

@stop

@section('scripts')	
@stop