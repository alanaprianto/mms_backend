@extends('admin.app')

@section('active-market')
  active
@stop
@section('active-market-category')
  active
@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Category</h2>
    <ol class="breadcrumb">
        <li>
            <a>Admin</a>
        </li>
        <li>
            <a>Marketplace</a>
        </li>
        <li>
            <a>Category</a>
        </li>
        <li class="active">
            <strong>Create</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a href='/' class="btn btn-primary" onclick="goBack()">
        <span class="fa fa-arrow-left fa-fw"></span>
        &nbsp;&nbsp;Back
      </a>
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

        	{!! Form::open(['action' => ['AdminCategoryController@index'], 'class' => 'form-horizontal']) !!}
        		@include('admin.marketplace.category.form', ['submitButtonText' => 'Add Category'])
        	{!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script>
  function goBack() {
    window.history.back();
  }
</script>
@endpush