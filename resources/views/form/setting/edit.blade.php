@extends('app')

@section('content')
	<h1>Edit: {!! $fsetting->name !!}</h1>

	<hr/>

	@include('errors.error_list')

	{!! Form::model($fsetting, ['method' => 'PATCH', 'action' => ['FormSettingController@update', $fsetting->id]]) !!}
		@include('form.setting.form', ['submitButtonText' => 'Update Form Setting'])	
	{!! Form::close() !!}
@stop