@extends('daerah.app')

@section('active-groupform')
  active
@stop
@section('active-formab')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Submitted Form</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>        
    <li>
      Submitted Form
    </li>
    <li class="active">
      <strong>Anggota Biasa</strong>
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
  <div class="col-lg-12">
    <div class="ibox float-e-margins">				
	  <div class="ibox-title">
		<h5>List Submitted Form </h5>
		<div class="ibox-tools">
          <a class="collapse-link">
			<i class="fa fa-chevron-up"></i>
		  </a>		  
		</div>
	  </div>
	  <div class="ibox-content">
		<table class="table table-striped table-bordered table-hover dataTables-example" id="list-table" width=100%>
		  <thead>
			<tr>      
			  <th>Company</th>
			  <th>Company Representative</th>
			  <th>Submitted At</th>
			  <th>Tracking Code</th>
			  <th>Options</th>
			</tr>        
		  </thead>
		</table>
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
		        	ASDAD		       
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
	<!-- ChartJS-->	
    <script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
    <script type="text/javascript">
		$(function() {
		  $('#list-table').DataTable({
		    processing: true,
		    serverSide: true,
		    iDisplayLength: 100,
		    aaSorting: [[1, 'desc']],
		    ajax: "{{ url('daerah/ajax/submittedforms')}}",
		    columns: [       		      
		      { "data" : "answer" },
		      { "data" : "name" },
		      { "data" : "created_at"},                  
		      { "data" : "trackingcode"},            
		      { "data" : "trackingcode"},
		    ],    
		    "columnDefs": [            
		      {		        
		        "render": function ( data, type, row ) {
		        return '<a href="submitted/detail/'+row.trackingcode+'/a" class="btn btn-warning btn-xs">'+
		        			'<span class="glyphicon glyphicon-search"></span>'+
		        			'&nbsp;&nbsp; Detail'+
		        		'</a>'+
		        		'&nbsp;&nbsp;'+
		        		'<a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="'+row.trackingcode+'" data-name="'+row.answer+'" data-url="member">'+
		        			'<span class="glyphicon glyphicon-trash"></span>'+
		        			'&nbsp;&nbsp;Delete'+
		        		'</a>';
		        },
		        "targets": 4
		      },		      
		    ]
		  });
		});

		$('#myModal').on('show.bs.modal', function (event) {  
		  var button = $(event.relatedTarget) // Button that triggered the modal    
		  id = button.data('id');
		  name = button.data('name');

		  console.log(id + " " + name);

		  var modal = $(this);
		  modal.find('.modal-body').text('Delete Record "' + name + '"?');
		  modal.find('.modal-footer .form-control').val(id);

		});		

		$('#submit_delete').on('click', function (event) {		  
		  var url = "{{ url('daerah/submitted/delete/') }}/"+id;

		  $.ajax({    
		    url: url,
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

		    location.reload();
		  });
		});
    </script>
@endpush