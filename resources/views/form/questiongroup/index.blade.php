@extends('app')

@section('content')

<h1> Form Question Group </h1>
<br><br>

@include('form.search_form', ['formUrl' => 'crud/form/question_group', 'createUrl' => 'question_group/create'])

<div class="table">
  @include('form.questiongroup.questiongroups')
</div>

@include('form.delete_modals', ['baseUrl' => '/question_group/'])

@include('form.pagination_script', ['baseUrl' => '/question_group/?page='])

@stop