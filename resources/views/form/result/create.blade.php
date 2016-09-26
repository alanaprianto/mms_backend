@extends('form.app')

@section('sidebar')
  @include('form.result.sidebar')
@stop

@section('content')
	<h1>Create New Form Result</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['FormResultController@index']]) !!}
		@include('form.result.form', ['submitButtonText' => 'Add Form Result'])			
	{!! Form::close() !!}

@stop
