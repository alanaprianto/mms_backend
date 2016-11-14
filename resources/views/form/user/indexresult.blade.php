@extends('form.app')

@section('sidebar')
  @include('form.user.sidebar')
@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Detail User</h2>
    <ol class="breadcrumb">
        <li>
            <a>Users</a>
        </li>
        <li class="active">
            <strong>Detail</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a href='/' class="btn btn-primary"><span class="fa fa-arrow-left fa-fw"></span>&nbsp;&nbsp;Back</a>
    </div>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Detail User</h5>
          <div class="ibox-tools"><!-- any link icon --></div>
        </div>
        <div class="ibox-content">
          <table class="table table-bordered" id="result-table" width=100%>
            <thead>
              <tr>      
                <th>Question</th>                  
                <th>Answer Value</th>    
                <th>User</th>
                <th>Tracking Code</th>      
                <th>Submitted At</th>
              </tr>        
            </thead>
          </table>
        </div>
      </div>
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
  var urlAjax = "{{ url('crud/form/ajax/userresultAjax/')}}/{{ $user->id }}";
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

      var ref = $('#result-table').DataTable();
      ref.ajax.reload(null, false);    
    });
  });

  $(function() {
    var ajax = urlAjax;
    console.log(ajax);

    $('#result-table').DataTable({
      processing: true,
      serverSide: true,
      iDisplayLength: 50,
      ajax: ajax,
      columns: [       
        { "data" : "question" },        
        { "data" : "answer" },        
        { "data" : "name"},        
        { "data" : "trackingcode"},      
        { "data" : "created_at"},      
      ],    
    });
  });

</script>
@endpush