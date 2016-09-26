@extends('form.app')

@section('sidebar')
  @include('form.question.sidebar')
@stop

@section('content')
	<h1>Edit: {!! $fq->name !!}</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::model($fq, ['method' => 'PATCH', 'action' => ['FormQuestionController@update', $fq->id]]) !!}
		@include('form.question.form', ['submitButtonText' => 'Update Form Question'])	
	{!! Form::close() !!}
	
@stop