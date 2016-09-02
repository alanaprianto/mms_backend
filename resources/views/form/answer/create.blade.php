@extends('app')

@section('content')
	<h1>Create New Form Answer</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['FormAnswerController@index']]) !!}
		@include('form.answer.form', ['submitButtonText' => 'Add Form Answer'])			
	{!! Form::close() !!}

@stop
