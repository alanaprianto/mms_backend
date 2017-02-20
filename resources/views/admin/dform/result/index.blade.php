@extends('admin.app')

@section('active-dform')
  active
@stop
@section('active-dform-result')
  active
@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Form Result</h2>
    <ol class="breadcrumb">
        <li>
            <a>Admin</a>
        </li>
        <li>
            <a>CRUD Forms</a>
        </li>
        <li class="active">
            <strong>Form Result</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a href='result/create' class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah Data</a>
    </div>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>List Result</h5>
          <div class="ibox-tools"><!-- any link icon --></div>
        </div>
        <div class="ibox-content">
          <table class="table table-striped table-bordered table-hover dataTables-example" id="result-table">
            <thead>
              <tr>
                <th>Question</th>
                <th>Answer Type</th>
                <th>Answer Value</th>
                <th>User</th>
                <th>Tracking Code</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

              <i class="fa fa-warning modal-icon"></i>
              <h4 class="modal-title">Warning!</h4>
          </div>
          <div class="modal-body">
              <p>This record will be deleted permanently.</p>
              <p>Are you sure to delete record <span class="recordname"></span></p>
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
  question = button.data('question');  
  answer = button.data('answer');

  var modal = $(this);
  modal.find('.modal-body').text('Delete Question "' + question + '", with answer: "' + answer + '"?');
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
  $('#result-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('admin/ajax/result')}}",
    columns: [       
      { "data" : "question" },
      { "data" : "answer_type" },
      { "data" : "answer" },        
      { "data" : "name"},        
      { "data" : "trackingcode"},
      { "data" : "id"}    
    ],
    "columnDefs": [
      {
        // The `data` parameter refers to the data for the cell (defined by the
        // `data` option, which defaults to the column being worked with, in
        // this case `data: 0`.
        "render": function ( data, type, row ) {
        return '<a href="result/'+row.id+'/edit" class="btn btn-white btn-xs">'+
                  '<span class="fa fa-edit fa-fw"></span>'+
                  '&nbsp;&nbsp;Edit'+
                '</a>&nbsp;'+
                '<a href="" title="Delete Item" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="'+row.id+'" data-question="'+row.question+'" data-answer="'+row.answer+'" data-url="result">'+
                  '<span class="fa fa-trash fa-fw"></span>'+
                '</a>';
        },
        "targets": 5
      }
    ]
  });
});

</script>
@endpush