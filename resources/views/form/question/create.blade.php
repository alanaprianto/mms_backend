@extends('form.app')

@section('sidebar')
  @include('form.question.sidebar')
@stop

@section('content')
	<h1>Create New Form Question</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['FormQuestionController@index']]) !!}
		@include('form.question.form', ['submitButtonText' => 'Add Form Question'])			
	{!! Form::close() !!}

@stop
