@extends('form.app')

@section('sidebar')
  @include('form.rules.sidebar')
@stop

@section('content')
	<h1>Edit: {!! $frules->name !!}</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::model($frules, ['method' => 'PATCH', 'action' => ['FormRulesController@update', $frules->id]]) !!}
		@include('form.rules.form', ['submitButtonText' => 'Update Form Rules'])	
	{!! Form::close() !!}
@stop