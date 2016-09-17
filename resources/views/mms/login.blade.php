@extends('mms.app')

@section('content')	

	<div class="well">
		<h1>Form Login</h1>
		<br>

		@include('errors.error_list')

		{!! Form::open(['action' => ['LoginController@login'], 'id' => 'wadah']) !!}			
			<div class="form-group">
				{!! Form::label('username', 'Username :') !!}
				{!! Form::text('username', null, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('password', 'Password :') !!}
				{!! Form::password('password', ['class' => 'form-control']) !!}
			</div>												

			<div class="form-group">
				{!! Form::submit('Submit!', ['class' => 'btn btn-primary form-control']) !!}
			</div>		
			
		{!! Form::close() !!}
	</div>
@stop

@section('scripts')	
@stop