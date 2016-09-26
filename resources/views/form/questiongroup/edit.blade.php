@extends('form.app')

@section('sidebar')
  @include('form.questiongroup.sidebar')
@stop

@section('content')
	<h1>Edit: {!! $fqg->name !!}</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::model($fqg, ['method' => 'PATCH', 'action' => ['FormQuestionGroupController@update', $fqg->id]]) !!}
		@include('form.questiongroup.form', ['submitButtonText' => 'Update Form Question Group'])	
	{!! Form::close() !!}
@stop