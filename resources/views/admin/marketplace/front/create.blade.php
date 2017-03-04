@extends('common.app')

@section('active-market')
  active
@stop
@section('active-market-frontend')
  active
@stop

@section('content')
    <div class="col-lg-10">
        <h2>Frontend</h2>
        <ol class="breadcrumb">
            <li>
                <a>Admin</a>
            </li>
            <li>
                <a>Marketplace</a>
            </li>
            <li>
                <a>Frontend</a>
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
@stop

@section('iframe')
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

        	{!! Form::open(['action' => ['Admin\AdminMFrontController@index'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
        		@include('admin.marketplace.front.form', ['submitButtonText' => 'Add Frontend'])
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