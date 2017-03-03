@extends('common.app')

@section('active-groupmember')
  active
@stop
@section('active-memberalb')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Members</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>
    <li>
      <a>Members</a>
    </li>
    <li class="active">
      <strong>Anggota Luar Biasa</strong>
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
		<h5>List Member {{ Auth::user()->name }} </h5>
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
</div>

<!-- Delete Modal -->
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

<!-- Validation Modal -->
<div class="modal inmodal" id="valModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content animated bounceInRight">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>						
		<h4 class="modal-title">Validation</h4>						
	  </div>
	  <div class="modal-body">
		<p id="thetext">Validasi pembayaran untuk tracking code </p>
		<div class="form-group">							
		  <input type="text" id="thecode" class="form-control" value="ASDAD" style="text-align:center; font-size: 24px; font-family: monospace;" readonly>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
		<button id="validate" type="button" class="btn btn-primary">Validasi</button>
	  </div>
	</div>
  </div>
</div>
@stop

@push('scripts')
	<!-- ChartJS-->	
    <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
    <script type="text/javascript">
		$(function() {
		  $('#list-table').DataTable({
		    processing: true,
		    serverSide: true,
		    iDisplayLength: 100,
		    ajax: "{{ url('daerah/ajax/members/alb')}}",
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
			        } else if (row.kta=="postponed") {
                        return 'KTA Request Postponed';
                    } else {
			        	return 'KTA Generated';
			        }
		        			        	
		            // if (row.paid=="paid"&&row.verifiedemail==true)   {
		            // 	return '<i class="fa fa-check text-navy"></i>'+
			        			// '&nbsp;&nbsp;Validated';
		            // } else {
		            // 	return '<a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#valModal" data-id="'+row.id+'" data-trcode="'+row.trackingcode+'" data-name="'+row.name+'">'+
			        			// 	'<span class="glyphicon glyphicon-check"></span>'+
			        			// 	'&nbsp;&nbsp;Validate'+
			        			// '</a>';
		            // }			        
		        },
		        "targets": 3
		      },
		      {		        
		        "render": function ( data, type, row ) {
			        return '<a href="alb/detail/'+row.id+'" class="btn btn-warning btn-xs">'+
					        	'<span class="glyphicon glyphicon-search"></span>'+
					        	'&nbsp;&nbsp;Detail'+
					        '</a>'+
					        '&nbsp;&nbsp;'+
					        '<a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="'+row.id+'" data-name="'+row.name+'" data-url="member">'+
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
		  url = button.data('url');
		  id = button.data('id');
		  name = button.data('name');

		  console.log(url + " " + id + " " + name);

		  var modal = $(this);
		  modal.find('.modal-body').text('Delete Record "' + name + '"?');
		  modal.find('.modal-footer .form-control').val(id);

		});

		$('#valModal').on('show.bs.modal', function (event) {  
		  var button = $(event.relatedTarget) // Button that triggered the modal    
		  var trcode = button.data('trcode');
		  id = button.data('id');
		  name = button.data('name');

		  console.log(trcode);

		  var modal = $(this);
		  modal.find('#thecode').val(trcode);
		  modal.find('#thetext').innerHTML = "";

		  modal.find('.modal-body').text('Validasi User "' + name + '"?');
		});

		$('#validate').on('click', function (event) {
		  console.log("validate clicked");		  		  

		  var url = "{{ url('daerah/member/validate/') }}/"+id;
		  		  
		  $.ajax({    
		    url: url,
		    type: "get",		    
		  }).done(function(data) {                    
		    console.log(data);

		    $('#valModal').modal('hide'); 

		    if (data.success) {
		      toastr.success(data.msg);
		    } else {
		      toastr.error(data.msg);
		    }

		    // location.reload();
		    setTimeout(location.reload.bind(location), 1000);
		  });
		});

		$('#submit_delete').on('click', function (event) {		  
		  var url = "{{ url('daerah/member/delete/') }}/"+id;

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

		    // location.reload();
		    setTimeout(location.reload.bind(location), 1000);
		  });
		});
    </script>
@endpush