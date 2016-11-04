@extends('form.app')

@section('sidebar')
  @include('form.type.sidebar')
@stop

@section('content')

	<h1>Create New Form Type</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['FormTypeController@index']]) !!}
		@include('form.type.form', ['submitButtonText' => 'Add Form Type'])			
	{!! Form::close() !!}

@stop
