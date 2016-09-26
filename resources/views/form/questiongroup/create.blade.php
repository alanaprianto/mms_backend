@extends('form.app')

@section('sidebar')
  @include('form.questiongroup.sidebar')
@stop

@section('content')
	<h1>Create New Form Question Group</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['FormQuestionGroupController@index']]) !!}
		@include('form.questiongroup.form', ['submitButtonText' => 'Add Form Question Group'])			
	{!! Form::close() !!}

@stop
