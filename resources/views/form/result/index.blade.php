@extends('app')

@section('content')

<h1> Form Result </h1>
<br><br>

@include('form.search_form', ['formUrl' => 'crud/form/result', 'createUrl' => 'result/create'])

<div class="table">
  @include('form.result.results')
</div>

@include('form.delete_modals', ['baseUrl' => '/result/'])

@include('form.pagination_script', ['baseUrl' => '/result/?page='])

@stop