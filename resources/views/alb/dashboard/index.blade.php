@extends('common.app')

@section('head')  
  <link href="{{ asset('css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
@stop

@section('active-dashboard')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
  <ol class="breadcrumb">
    <li>
      <a>Extraordinary Member</a>
    </li>
    <li class="active">
      <strong>Dashboard</strong>
    </li>
  </ol>
</div>
@stop

@section('iframe')
<div class="col-lg-6">
  @if ($corr>0||$comm>0)
  <div class="row">
    <a href="{{ url('alb/compprof') }}">
      <div class="col-lg-6">
        <div class="widget style1 yellow-bg">
          <div class="row">
            <div class="col-xs-4">
              <i class="fa fa-warning fa-5x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <span> Commentary </span>
              <h2 class="font-bold">{{ $comm }}</h2>
            </div>
          </div>
        </div>
      </div>
    </a>
    <a href="{{ url('alb/compprof') }}">
      <div class="col-lg-6">
        <div class="widget style1 red-bg">
          <div class="row">
            <div class="col-xs-4">
              <i class="fa fa-warning fa-5x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <span> Correction </span>
              <h2 class="font-bold">{{ $corr }}</h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>KTA Status</h5>
        </div>
        <div class="ibox-content">
          <h4 align="center">
          @if ($exp_show)
            {{ $exp_text1 }}<br><br>
            <strong>{{ $exp_text2 }}</strong>          
            <br><br>
            <a href="{{ url('alb/kta') }}">
              <button type="submit" class="btn btn-success">
                See your KTA detail.
              </button>
            </a>
          @else
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
              <a href="{{ url('alb/kta') }}">
                <button type="submit" class="btn btn-danger">
                  See Why your KTA is cancelled.
                </button>
              </a>
            @else
              Your KTA is generated.<br><br>
              <a href="{{ url('alb/kta') }}">
                <button type="submit" class="btn btn-success">
                  See your KTA detail.
                </button>
              </a>
            @endif
          @endif
          </h4>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
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
            <a href="{{ url('alb/kta') }}">
              <button type="submit" class="btn btn-danger">
                See Why your RN is cancelled.
              </button>
            </a>
          @else
            Your RN Number is generated.<br><br>
            <a href="{{ url('alb/rn') }}">
              <button type="submit" class="btn btn-success">
                See your RN detail.
              </button>
            </a>          
          @endif
          </h4>                
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
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
                  <p class="form-control-static no-padding">{{ $member->username }}</p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-4 control-label no-padding">Tracking Code</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $detail[0]['trackingcode'] }}</p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-4 control-label no-padding">Submitted At</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $member->created_at }}</p>
                </div>
              </div>          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
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
              <!-- identitas user -->
              <div class="form-group no-padding">
                <label class="col-lg-6 control-label no-padding">Nama Asosiasi/Himpunan</label>
                <div class="col-lg-6">
                  <p class="form-control-static no-padding">{{ $nasosiasi }}</p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-6 control-label no-padding">Tingkat</label>
                <div class="col-lg-6">
                  <p class="form-control-static no-padding">{{ $tingkat }}</p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-6 control-label no-padding">Daerah</label>
                <div class="col-lg-6">
                  <p class="form-control-static no-padding">{{ $daerah }}</p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-6 control-label no-padding">Provinsi</label>
                <div class="col-lg-6">
                  <p class="form-control-static no-padding">{{ $provinsi }}</p>
                </div>
              </div>            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-6">
  <div class="row">
    <div class="col-lg-12">
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
              <a href="{{ url('/uploadedfiles') }}/{{ $member->username}}:::{{ explode('.', $doc->answer_value)[0] }}" data-gallery="">
                <img src="{{ url('/uploadedfiles') }}/{{ $member->username}}:::{{ explode('.', $doc->answer_value)[0] }}-thumbs">
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
              <a href="{{ url('dashboard\alb\completeprofile\24') }}">
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
    <div class="col-lg-12">
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
            <ul id="wadahpagination" class="pagination c-theme"></ul>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<div class="row">
</div>
<br/><br/>
@stop

@push('scripts')
<script src="{{ asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
<script src="{{ asset('js/getnews.js') }}"></script>
@endpush