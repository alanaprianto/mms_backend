@extends('form.app')

@section('sidebar')
	@include('form.dashboard.sidebar')
@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Dashboard</h2>
    <ol class="breadcrumb">
        <li>
            <a>Admin</a>
        </li>        
        <li class="active">
            <strong>Dashboard</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">    
  </div>
</div>

<br>
<div class="row">
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">CRUD Form</span>
          <h5>Form Setting</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalsetting }}</h1>        
        <small>Total Form Setting</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">CRUD Form</span>
          <h5>Form Type</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totaltype }}</h1>        
        <small>Total Form Type</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">CRUD Form</span>
          <h5>Form Rules</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalrules }}</h1>        
        <small>Total Form Rules</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">CRUD Form</span>
          <h5>Form Question</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalquestion }}</h1>        
        <small>Total Form Question</small>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">CRUD Form</span>
          <h5>Form Question Group</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalqgroup }}</h1>        
        <small>Total Form Question Group</small>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">CRUD Form</span>
          <h5>Form Answer</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalanswer }}</h1>        
        <small>Total Form Answer</small>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">CRUD Form</span>
          <h5>Form Result</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalresult }}</h1>        
        <small>Total Form Result</small>
      </div>
    </div>
  </div>                
</div>
@stop