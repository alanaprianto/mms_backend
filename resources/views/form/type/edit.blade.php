@extends('app')

@section('content')
	<h1>Edit: {!! $ftype->name !!}</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::model($ftype, ['method' => 'PATCH', 'action' => ['FormTypeController@update', $ftype->id]]) !!}
		@include('form.type.form', ['submitButtonText' => 'Update Form Type'])	
	{!! Form::close() !!}
@stop