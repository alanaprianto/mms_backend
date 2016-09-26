@extends('form.app')

@section('sidebar')
  @include('form.result.sidebar')
@stop

@section('content')
	<h1>Edit: {!! $fr->description !!}</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::model($fr, ['method' => 'PATCH', 'action' => ['FormResultController@update', $fr->id]]) !!}
		@include('form.result.form', ['submitButtonText' => 'Update Form Result'])	
	{!! Form::close() !!}
@stop