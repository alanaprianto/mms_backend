@extends('app')

@section('content')

<h1> Form Setting </h1>
<br><br>

@include('form.search_form', ['formUrl' => 'crud/form/setting', 'createUrl' => 'setting/create'])
  
<div class="table">
  @include('form.setting.settings')
</div>

@include('form.delete_modals', ['baseUrl' => '/setting/'])

@include('form.pagination_script', ['baseUrl' => '/setting/?page='])

@stop