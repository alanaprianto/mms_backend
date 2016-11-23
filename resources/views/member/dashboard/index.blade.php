@extends('member.app')

@section('head')  
  <link href="{{ asset('resources/assets/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">  
@stop

@section('sidebar')
  @include('member.dashboard.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li class="active">
      <strong>Dashboard</strong>
    </li>
  </ol>
</div>
@stop

@section('iframe')
<div class="row">

  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>KTA Status</h5>
      </div>
      <div class="ibox-content">
        <h4 align="center">
        @if ($kta=="")
          KTA is not requested.<br>
          Complete your Account Information.
        @elseif ($kta=="requested")
          KTA is requested.<br>
          Waiting for Validation.
        @elseif ($kta=="validated")
          KTA is validated.<br>
          Waiting for Generation.
        @elseif ($kta=="cancelled")
          Your KTA request is cancelled.<br><br>
          <a href="{{ url('member/kta') }}">
            <button type="submit" class="btn btn-danger">
              See Why your KTA is cancelled.
            </button>
          </a>
        @else
          Your KTA is generated.<br><br>
          <a href="{{ url('member/kta') }}">
            <button type="submit" class="btn btn-success">
              See your KTA detail.
            </button>
          </a>          
        @endif
        </h4>
      </div>
    </div>
  </div>

  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">        
        <h5>National Registration</h5>
      </div>
      <div class="ibox-content">
        <h4 align="center">        
        @if ($rn=="")
          RN Number is not yet requested.<br>          
        @elseif ($rn=="requested")
          RN Number is requested.<br>
          Still in process.
        @elseif ($rn=="cancelled")
          Your RN Number request is cancelled.<br><br>
          <a href="{{ url('member/kta') }}">
            <button type="submit" class="btn btn-danger">
              See Why your RN is cancelled.
            </button>
          </a>
        @else
          Your RN Number is generated.<br><br>
          <a href="{{ url('member/rn') }}">
            <button type="submit" class="btn btn-success">
              See your RN detail.
            </button>
          </a>          
        @endif
        </h4>                
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="pull-right">
          <small>({{ $cdoc }}/{{ $rdoc }})</small>
        </span>
        <h5>Documents Uploaded</h5>
      </div>
      <div class="ibox-content">
        <div class="lightBoxGallery">
          @foreach ($docs as $key=>$doc)
            <a href="{{ url('/uploadedfiles') }}/{{ $member->username}}_{{ $doc->id_question }}" data-gallery="">
              <img src="{{ url('/uploadedfiles') }}/{{ $member->username}}_{{ $doc->id_question }}-thumbs">
            </a>
          @endforeach
          <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
          <div id="blueimp-gallery" class="blueimp-gallery">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
          </div>
        </div>
        @if ($cdoc==0)
          <h4 align="center">
            <a href="{{ url('member\completeprofile\22') }}">
              <button type="submit" class="btn btn-success">
                Upload Scanned Document
              </button>
            </a>
          </h4>
        @endif        
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
              <p class="form-control-static">{{ $member->username }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Tracking Code</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $detail[0]['trackingcode'] }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Submitted At</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $member->created_at }}</p>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
        </div>
      </div>
      </div>
    </div>

    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Profile Summary</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>          
        </div>
      </div>
      <div class="ibox-content">
        <div class="row">
        <div class="col-lg-12">
          @unless ($percentage == 100 || $percentage == 0)     
            <span class="pull-right">
              <a href="{{ url('member\registerii') }}">
                Complete your account Information
              </a>
            </span>
          @endunless
          <h5>Your Account Information ({{ $completed }}/{{ $required }})</h5>          
          <div class="progress progress-striped active">
            <div style="width: {{ $percentage}}%" aria-valuemax="{{ $required }}" aria-valuemin="0" aria-valuenow="{{ $completed }}" role="progressbar" class="progress-bar progress-bar-success">    
            </div>
          </div>          

          <!-- identitas user -->
          <div class="form-group">
            <label class="col-lg-6 control-label">Nama Perusahaan</label>
            <div class="col-lg-6">
              <p class="form-control-static">{{ $compform }} {{ $compname }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-6 control-label">Klasifikasi Perusahaan</label>
            <div class="col-lg-6">
              <p class="form-control-static">{{ $compclass }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-6 control-label">Daerah</label>
            <div class="col-lg-6">
              <p class="form-control-static">{{ $daerah }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-6 control-label">Provinsi</label>
            <div class="col-lg-6">
              <p class="form-control-static">{{ $provinsi }}</p>
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
<script src="{{ asset('resources/assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
@endpush