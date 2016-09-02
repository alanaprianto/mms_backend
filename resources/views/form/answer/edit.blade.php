@extends('app')

@section('content')
	<h1>Edit: {!! $fa->name !!}</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::model($fa, ['method' => 'PATCH', 'action' => ['FormAnswerController@update', $fa->id]]) !!}
		@include('form.answer.form', ['submitButtonText' => 'Update Form Answer'])	
	{!! Form::close() !!}
	
@stop