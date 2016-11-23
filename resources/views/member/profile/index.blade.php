@extends('member.app')

@section('sidebar')
  @include('member.sidebar-plain')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Profile</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>        
    <li class="active">
      <strong>Profile</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
<div class="wrapper wrapper-content">
  <div class="row animated fadeInRight">
    <div class="col-md-4">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Profile Detail</h5>
        </div>
        <div>
          <div class="ibox-content col-centered">
            <img alt="image" class="img-responsive" src="{{ url('/images') }}/{{ Auth::user()->username}}">
          </div>
          <div class="ibox-content profile-content">
            <h4><strong>{{ Auth::user()->username }}</strong></h4>
            <p><i class="fa fa-map-marker"></i> {{ Auth::user()->territory_name }}</p>
            <br>            
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="ibox float-e-margins">
        <div id="judul" class="ibox-title">
          <h5>Your Account Information</h5>
        </div>
        <div id="wadah">
          <div class="ibox-content col-centered">            
          </div>
          <div class="ibox-content profile-content">
            <form class="form-horizontal">
              <div class="form-group">
                <label class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                  <p class="form-control-static">{{ $name }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                  <p class="form-control-static">{{ $email }}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                  <p class="form-control-static">{{ $username }}</p>
                </div>
              </div>

              <div class="mail-tools tooltip-demo m-t-md">                      
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#profileimgModal" title="Change Your Profile Picture">
                  Change Your Profile Picture
                </a>
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCAI" title="Change Account Information">
                  Change Account Information
                </a>
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCYP" title="Change Your Password">
                  Change Your Password
                </a>
              </div>
            </form>
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Change Profile Picture -->
        <div class="modal inmodal fade" id="profileimgModal" tabindex="-1" role="dialog" aria-labelledby="profileimgModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content animated bounceInRight">
              <form id="imgUploadForm" action="{{ url('image-upload') }}" enctype="multipart/form-data" method="POST">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                  <i class="fa fa-image modal-icon"></i>
                  <h4 class="modal-title" id="profileimgModalLabel">Your Photo</h4>
                  <small class="font-bold">Change Your Profile Image</small>
                </div>
                <div class="modal-body">
                  <div class="center-block" align="center">
                    <img id="theimage" src="{{ url('/images') }}/{{ Auth::user()->username}}" alt="your image" class="img-responsive center-block" width="250px"/>
                    &nbsp;
                    @if (count($errors) > 0)
                      <p>
                        <div class="alert alert-danger">
                          <strong>Whoops!</strong> There were some problems with your input.<br><br>
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      </p>
                    @endif
                    
                    {{ csrf_field() }}
                    <div class="input-group-btn">
                      <div class="btn btn-primary btn-file">
                        <i class="glyphicon glyphicon-folder-open"></i>&nbsp;
                        <span class="hidden-xs">Browse …</span>
                        <input name="image" type="file" id="imgInp">
                      </div>
                      &nbsp;
                      <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

<!-- Modal Change Account Information -->
<div class="modal inmodal fade" id="modalCAI" tabindex="-1" role="dialog" aria-labelledby="modalCAILabel">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Change Account Information</h4>
      </div>
      <div class="modal-body">
        <form id="form_account" class="form-horizontal">
          <div class="form-group">
            <label class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ $name }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
              <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ $email }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Username</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Username" id="username" name="username" value="{{ $username }}">
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

<!-- Modal Change Account Information -->
<div class="modal inmodal fade" id="modalCYP" tabindex="-1" role="dialog" aria-labelledby="modalCYPLabel">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Change Your Password</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form_password">
          <div class="form-group">
            <label class="col-lg-4 control-label">Old Password</label>
            <div class="col-lg-8">
              <input type="password" class="form-control" placeholder="Password" id="oldpassword" name="oldpassword" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">New Password</label>
            <div class="col-lg-8">
              <input type="password" class="form-control" placeholder="Password" id="newpassword" name="newpassword" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Confirm New Password</label>
            <div class="col-lg-8">
              <input type="password" class="form-control" placeholder="Password" id="confirmpassword" name="confirmpassword" required="">
            </div>
          </div>
        </form>        
      </div>
      <div class="modal-footer">
        <input type="hidden" class="form-control" id="id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="submitCYP" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

@stop

@push('scripts')
<!-- Jquery Validate -->
<script src="{{ asset('resources/assets/js/plugins/validate/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
  $('#modalCAI').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal    

    document.getElementById('name').value = "{{ $name }}";
    document.getElementById('email').value = "{{ $email }}";
    document.getElementById('username').value = "{{ $username }}";

    // document.getElementById('username').value = "{{ csrf_token() }}";
  });  

  $('#modalCYP').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal    

    document.getElementById('oldpassword').value = '';
    document.getElementById('newpassword').value = '';
    document.getElementById('confirmpassword').value = '';

    // document.getElementById('username').value = "{{ csrf_token() }}";
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
        }               
      }
    });

    $("#form_password").validate({
      rules: {
        oldpassword: {
          required: true,
        },
        newpassword: {
          required: true,
        }, 
        confirmpassword: {
          required: true,
        }
      }
    });    

    $('#submitCYP').on('click', function (event) {      
      opass = document.getElementById('oldpassword').value;
      npass = document.getElementById('newpassword').value;
      cpass = document.getElementById('confirmpassword').value;

      console.log(opass);
      if ($("#form_password").valid()) {
        $.ajax({
          url: "{{ url('updateCYP') }}"+"/"+"{{ Auth::user()->id }}",
          type: "post",
          data: {              
            _token: "{{ csrf_token() }}",
            oldpassword: opass,
            newpassword: npass,
            confirmpassword: cpass,
          }
        }).done(function(data) {          
          $('#modalCYP').modal('hide');

          if (data.success) {
            toastr.success(data.msg);
          } else {
            toastr.error(data.msg);
          }

          $('#modalCYP').modal('hide');

          // location.reload();
          // setTimeout(location.reload.bind(location), 1000);
          console.log(data.msg);
        });
      }      
    });

    $('#submitCAI').on('click', function (event) {      
      name = document.getElementById('name').value;
      email = document.getElementById('email').value;
      username = document.getElementById('username').value;

      if ($("#form_account").valid()) {
        $.ajax({
          url: "{{ url('updateCAI') }}"+"/"+"{{ Auth::user()->id }}",
          type: "post",
          data: {              
            _token: "{{ csrf_token() }}",
            name: name,
            email: email,
            username: username,
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
