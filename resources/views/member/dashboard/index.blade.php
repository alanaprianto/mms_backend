@extends('common.app')

@section('head')  
  <link href="{{ asset('css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
  <style rel="stylesheet">
    .link
    {
      color:white;
      text-decoration: none;
      background-color: none;
    }
  </style>
@stop

@section('active-dashboard')
  active
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
<div class="col-lg-6">
  @if ($corr>0||$comm>0)
  <div class="row link">
    <a href="{{ url('member/compprof') }}">
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
    <div class="col-lg-6">
      <a href="{{ url('member/compprof') }}">
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
      </a>
    </div>
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
            <a href="{{ url('member/kta') }}">
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
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Username</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $member->username }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Tracking Code</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $detail[0]['trackingcode'] }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
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
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Nama Perusahaan</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $compform }} {{ $compname }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Klasifikasi Perusahaan</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $compclass }}</p>
                </div>
              </div>
              <br>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Daerah</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $daerah }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Provinsi</label>
                <div class="col-lg-8">
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
          <h5>Collaboration Account</h5>
        </div>
        <div class="ibox-content">
          <h4>            
            @if($chat)
              Your collaboration account is available.
              <a href="https://chat.kadin-collab.com/home">
                <button type="submit" class="btn btn-success pull-right">
                  Go to Collaboration
                </button>
              </a>
            @else
              You haven't created collaboration account.
              <button type="submit" class="btn btn-success pull-right" data-toggle="modal" data-target="#modalCAI">
                Create Account
              </button>
            @endif
            <small>
              <a href="https://mobile.kadin-collab.com/cmis-member/cmis-member-v1.0.apk">
                Download collaboration apps for mobile.
              </a>
            </small>
          </h4>
        </div>
      </div>
    </div>
  </div>  
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
              <a href="{{ url('member\completeprofile\18') }}">
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
<br><br>
<!-- Modal Change Account Information -->
<div class="modal inmodal fade" id="modalCAI" tabindex="-1" role="dialog" aria-labelledby="modalCAILabel">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Create Collaboration Account</h4><br/>
        Your collaboration account credentials is the same as your mms credentials. <br/>
        If you update your mms account, your collaboration account would also change.        
      </div>
      <div class="modal-body">
        <form id="form_account" class="form-horizontal">
          <div class="form-group">
            <label class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ Auth::user()->name }}" disabled="disabled">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
              <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ Auth::user()->email }}" disabled="disabled">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Username</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Username" id="username" name="username" value="{{ Auth::user()->username }}" disabled="disabled">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Password</label>
            <div class="col-lg-10">
              <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Confirm Password</label>
            <div class="col-lg-10">
              <input type="password" class="form-control" placeholder="Password" id="confirmpassword" name="confirmpassword" required="">
            </div>
          </div>
        </form>        
      </div>
      <div class="modal-footer">
        <input type="hidden" class="form-control" id="id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="submitCAI" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script src="{{ asset('js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
<script src="{{ asset('js/getnews.js') }}"></script>
<script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
  $('#modalCAI').on('show.bs.modal', function (event) {  

    document.getElementById('password').value = "";
    document.getElementById('confirmpassword').value = "";    
    
  });

  $(document).ready(function(){
    $("#form_account").validate({
      rules: {        
        name: {
          required: true,
        },
        email: {
          required: true,
        },
        username: {
          required: true,
        },
        password: {
          required: true,
        }, 
        confirmpassword: {
          required: true,
        }
      }
    });

    $('#submitCAI').on('click', function (event) {
      name = document.getElementById('name').value;
      email = document.getElementById('email').value;
      username = document.getElementById('username').value;
      password = document.getElementById('password').value;
      confirmpassword = document.getElementById('confirmpassword').value;

      if ($("#form_account").valid()) {
        $.ajax({
          url: "{{ url('crtCollaboration') }}"+"/"+"{{ Auth::user()->id }}",
          type: "post",
          data: {
            _token: "{{ csrf_token() }}",
            name: name,
            email: email,
            username: username,
            password: password,
            confirmpassword: confirmpassword,
          }
        }).done(function(data) {
          $('#modalCAI').modal('hide');

          if (data.success) {
            toastr.success(data.msg);
          } else {
            toastr.error(data.msg);
          }          

          // location.reload();
          setTimeout(location.reload.bind(location), 1000);
        });
      }
    });
  });  
</script>
@endpush