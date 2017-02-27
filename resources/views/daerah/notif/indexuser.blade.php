@extends('daerah.app')

@section('sidebar')
  @include('daerah.sidebar-plain') 
@stop

@section('content')
  <div class="col-lg-1o">
    <h1> Notification from Member </h1>
  </div>
@endsection

@section('iframe')
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-content">
      <table class="table table-bordered" id="user-table" width=100%>
        <thead>
        <tr>
          <th>Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Status KTA</th>
          <th>Options</th>
        </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        Delete Record No 
      </div>
      <div class="modal-footer">        
        <input type="hidden" class="form-control" id="id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="submit_delete" type="submit" class="btn btn-danger">Delete</button>    
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script>
$('#myModal').on('show.bs.modal', function (event) {  
  var button = $(event.relatedTarget) // Button that triggered the modal    
  url = button.data('url');
  id = button.data('id');
  name = button.data('name');

  console.log(url + " " + id + " " + name);

  var modal = $(this);
  modal.find('.modal-body').text('Delete Record "' + name + '"?');
  modal.find('.modal-footer .form-control').val(id);

});

$('#submit_delete').on('click', function (event) {
  console.log("submit clicked");
  console.log(url+"/"+id);    

  $.ajax({    
    url: url+"/"+id,
    type: "post",
    data: {
      _method: 'DELETE', 
      _token: "{{ csrf_token() }}",        
    }
  }).done(function(data) {                    
    console.log(data);

    $('#myModal').modal('hide'); 

    if (data.success) {
      toastr.success(data.msg);
    } else {
      toastr.error(data.msg);
    }

    var ref = $('#user-table').DataTable();
    ref.ajax.reload(null, false);    
  });
});

$(function() {
  var url = "{{ url('daerah/member')}}";
  $('#user-table').DataTable({
    processing: true,
    serverSide: true,
    iDisplayLength: 50,
    ajax: "{{ url('daerah/ajax/notifuser/')}}/{{ $id }}",
    columns: [            
      { "data" : "name" },
      { "data" : "username" },
      { "data" : "email" },  
      { "data" : "id"}      
    ],
    "columnDefs": [
      {
          "render": function ( data, type, row ) {
              if (row.ext) {
                  if (row.ext=="requested") {
                      if (row.kta=="requested") {
                          return 'KTA Extension Requested, Waiting for Validation';
                      } else if (row.kta=="validated") {
                          return 'Profile Validated, waiting for KTA Extension';
                      } else if (row.kta=="cancelled") {
                          return 'KTA Extension Request Cancelled';
                      } else {
                          return 'KTA is Expired, Extension Requested';
                      }
                  } else if (row.ext.indexOf("processed") !== -1) {
                      if (row.kta=="requested") {
                          return 'KTA Extension is Processed, Waiting for Validation';
                      } else if (row.kta=="validated") {
                          return 'Profile Validated, waiting for KTA Extension';
                      } else if (row.kta=="cancelled") {
                          return 'KTA Extension Request Cancelled';
                      } else {
                          return 'KTA is Expired, Extension Requested';
                      }
                  }
              }

              if (row.kta==""||row.kta==null) {
                  return 'Not Yet Requested, Completing Profile Information';
              } else if (row.kta=="requested") {
                  return 'KTA Requested, Waiting for Validation';
              } else if (row.kta=="validated") {
                  return 'Profile Validated, waiting for KTA Generation';
              } else if (row.kta=="cancelled") {
                  return 'KTA Request Cancelled';
              } else {
                  return 'KTA Generated';
              }
          },
          "targets": 3
      },
      {
        "render": function ( data, type, row ) {
            if (row.trackingcode.indexOf('ALB') !== -1) {
                url = "{{ url('daerah/member/alb') }}";
            }
            return '<a href="'+url+'/detail/'+row.id+'" class="btn btn-warning btn-xs">'+
                      '<span class="glyphicon glyphicon-search"></span>'+
                      '&nbsp;&nbsp;Detail'+
                    '</a>'+
                    '<a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="'+row.id+'" data-name="'+row.name+'" data-url="user">'+
                      '<span class="glyphicon glyphicon-trash"></span>'+
                      '&nbsp;&nbsp;Delete'+
                    '</a>';
        },
        "targets": 4
      },
      // {        
      //   "render": function ( data, type, row ) {
      //   return '<p>"'+row.html_tag+'"</p>';
      //   },
      //   "targets": 2
      // }
    ]
  });
});

</script>
@endpush