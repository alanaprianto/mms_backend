@extends('daerah.app')

@section('sidebar')
  @include('daerah.dashboard.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>
    <li class="active">
      <strong>Dashboard</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
<div class="row">
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">Form</span>
          <h5>Submitted Form</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalsubmitted }}</h1>        
        <small>Total Submitted Form</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">Member</span>
          <h5>Member</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalmember }}</h1>        
        <small>Total Member</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">Member</span>
          <h5>Validated Member</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalverified }}</h1>        
        <small>Total Validated Member</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">Member</span>
          <h5>Unvalidated Member</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalunverified }}</h1>        
        <small>Total Unvalidated Member</small>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>At A Glance</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>          
        </div>
      </div>
      <div class="ibox-content">
        <div class="row">
        <div class="col-lg-12">
          <!-- identitas user -->
          <div class="form-group">
            <label class="col-lg-4 control-label">Username</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $user->username }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Role</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $user->myrole->name }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Daerah</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $user->territory_name }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Provinsi</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $provinsi->provinsi }}</p>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Kadin News</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>          
        </div>
      </div>
      <div class="ibox-content">
        <div class="feed-activity-list">
          
          <div class="feed-element">
            <div>
              <a href="">
                <i class="fa fa-envelope fa-fw"></i> 
                <strong>Judul Berita 1</strong>
              </a>
              <small class="pull-right text-navy">1m ago</small>
              <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
              <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
            </div>
          </div>

          <div class="feed-element">
            <div>
              <a href="">
                <i class="fa fa-envelope fa-fw"></i> 
                <strong>Judul Berita 2</strong>
              </a>
              <small class="pull-right text-navy">1m ago</small>
              <div>There are many variations of passages of Lorem Ipsum available</div>
              <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
            </div>
          </div>

          <div class="feed-element">
            <div>
              <a href="">
                <i class="fa fa-envelope fa-fw"></i> 
                <strong>Judul Berita 3</strong>
              </a>
              <small class="pull-right text-navy">1m ago</small>
              <div>There are many variations of passages of Lorem Ipsum available</div>
              <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')

@endpush