@extends('common.app')

@section('active-organizer')
    active
@stop
@section('active-organizer-list')
    active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Edit Organizer</h2>
  <ol class="breadcrumb">
    <li>
      <a>Admin</a>
    </li>
    <li>
      <a>Organizer</a>
    </li>
    <li class="active">
      <strong>Edit</strong>
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
          <h5>Edit Item</h5>
          <div class="ibox-tools"><!-- any link icon --></div>
        </div>
        <div class="ibox-content">
          @include('errors.error_list')

          {!! Form::model($pengurus, ['method' => 'PATCH', 'action' => ['OrganizerListController@update', $pengurus->id], 'class' => 'form-horizontal']) !!}
            @include('common.organizer.list.form', ['submitButtonText' => 'Update Organizer'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal Change Password -->
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
<script>
  function goBack() {
    window.history.back();
  }

  $('#modalCYP').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal    

    document.getElementById('oldpassword').value = '';
    document.getElementById('newpassword').value = '';
    document.getElementById('confirmpassword').value = '';

    // document.getElementById('username').value = "{{ csrf_token() }}";
  });

  $(document).ready(function(){    
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
      
      if ($("#form_password").valid()) {
        $.ajax({
          url: "{{ url('admin/organizer/list/updateCYP/') }}"+"/"+"{{ $pengurus->id }}",
          type: "post",
          data: {              
            _token: "{{ csrf_token() }}",
            oldpassword: opass,
            newpassword: npass,
            confirmpassword: cpass,
          }
        }).done(function(data) {
          console.log(data);

          $('#modalCYP').modal('hide');

          if (data.success) {
            toastr.success(data.msg);
          } else {
            toastr.error(data.msg);
          }          

          // location.reload();
          // setTimeout(location.reload.bind(location), 1000);          
        });
      }      
    });
  });
</script>
@endpush