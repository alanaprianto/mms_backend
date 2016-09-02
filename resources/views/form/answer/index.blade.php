@extends('app')

@section('content')

<h1> Form Answer </h1>
<br><br>

@include('form.search_form', ['formUrl' => 'crud/form/answer', 'createUrl' => 'answer/create'])

<div class="table">
  @include('form.answer.answers')
</div>

@include('form.delete_modals', ['baseUrl' => '/answer/'])

@include('form.pagination_script', ['baseUrl' => '/answer/?page='])

@stop