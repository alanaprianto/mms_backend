@extends('form.app')

@section('sidebar')
  @include('form.question.sidebar')
@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Form Question</h2>
    <ol class="breadcrumb">
        <li>
            <a>CRUD Forms</a>
        </li>
        <li>
            <a>Form Question</a>
        </li>
        <li class="active">
            <strong>Create New</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a href='/' class="btn btn-primary"><span class="fa fa-arrow-left fa-fw"></span>&nbsp;&nbsp;Back</a>
    </div>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Create New</h5>
          <div class="ibox-tools"><!-- any link icon --></div>
        </div>
        <div class="ibox-content">
          @include('errors.error_list')

        	{!! Form::open(['action' => ['FormQuestionController@index'], 'class' => 'form-horizontal']) !!}
        		@include('form.question.form', ['submitButtonText' => 'Add Form Question'])
        	{!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
