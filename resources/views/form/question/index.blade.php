@extends('form.app')

@section('sidebar')
  @include('form.question.sidebar')
@stop

@section('content')

<h1> Form Question </h1>
<br><br>

<div class="nopadding" align="left">
  <a href='question/create' class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah Data</a>
</div>  
<br>
  
<table class="table table-bordered" id="question-table" width=100%>
  <thead>
    <tr>
      <th>Question</th>    
      <th>Group Question</th>
      <th>Question Type</th>
      <th>Answer Type</th>
      <th>Rules</th>      
      <th>Order</th>
      <th>Options</th>
    </tr>        
  </thead>
</table>

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

    var ref = $('#question-table').DataTable();
    ref.ajax.reload(null, false);    
  });
});

$(function() {  
    $('#question-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('crud/form/ajax/question')}}",
        columns: [   
            { "data" : "question" },
            { "data" : "group_name" },
            { "data" : "question_type.name" },
            { "data" : "setting.name" },
            { "data" : "rules_detail[].name" },            
            { "data" : "order" },
            { "data" : "id" },            
        ], 
        "columnDefs": [            
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                	return '<a href="question/'+row.id+'/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a> <a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="'+row.id+'" data-name="'+row.question+'" data-url="question"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a>';                  
                    // return data +' ('+ row[3]+')';
                },
                "targets": 6
            }
        ]
    });
});
</script>
@endpush