@extends('app')

@section('content')
	<h1>Create New Form Setting</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::open(['action' => ['FormSettingController@index']]) !!}
		@include('form.setting.form', ['submitButtonText' => 'Add Form Setting'])			
	{!! Form::close() !!}

@stop
