@extends('common.app')

@section('active-dashboard')
	active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
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
          <div class="form-group no-padding">
            <label class="col-lg-4 control-label no-padding">Username</label>
            <div class="col-lg-8">
              <p class="form-control-static no-padding">{{ $user->username }}</p>
            </div>
          </div>
          <div class="form-group no-padding">
            <label class="col-lg-4 control-label no-padding">Role</label>
            <div class="col-lg-8">
              <p class="form-control-static no-padding">{{ $user->myrole->name }}</p>
            </div>
          </div>          
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
          <div id="wadahnews">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script src="{{ asset('js/getnews.js') }}"></script>
@endpush