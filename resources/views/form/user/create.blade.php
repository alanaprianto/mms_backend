@extends('form.app')

@section('sidebar')
  @include('form.user.sidebar') 
@stop

@section('content')
	<h1>Create New User</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['UserController@index']]) !!}
		@include('form.user.form', ['submitButtonText' => 'Add User'])			
	{!! Form::close() !!}

@stop
