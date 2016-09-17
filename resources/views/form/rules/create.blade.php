@extends('app')

@section('content')
	<h1>Create New Form Rules</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['FormRulesController@index']]) !!}
		@include('form.rules.form', ['submitButtonText' => 'Add Form Rules'])			
	{!! Form::close() !!}

@stop
