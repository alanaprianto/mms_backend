@extends('app')

@section('content')

<h1> Form Question </h1>
<br><br>

@include('form.search_form', ['formUrl' => 'crud/form/question', 'createUrl' => 'question/create'])

<div class="table">
  @include('form.question.questions')
</div>

@include('form.delete_modals', ['baseUrl' => '/question/'])

@include('form.pagination_script', ['baseUrl' => '/question/?page='])

@stop