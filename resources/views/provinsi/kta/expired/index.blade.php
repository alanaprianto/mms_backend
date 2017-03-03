@extends('common.app')

@section('active-groupkta')
	active
@stop
@section('active-ktaexp')
	active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Expired KTA</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
      </li>
      <li>
        <a>KTA</a>
      </li>
      <li class="active">
        <strong>Expired KTA</strong>        
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
		<h5>List Expired KTA</h5>
		<div class="ibox-tools">
		  <a class="collapse-link">
			<i class="fa fa-chevron-up"></i>
		  </a>
		</div>
	  </div>
	  <div class="ibox-content">
		<table class="table table-bordered" id="list-table" width=100%>
		  <thead>
			<tr>
			  <th>Company</th>
			  <th>Company Representative</th>
			  <th>Status KTA</th>
			  <th>Expired At</th>
			  <th>Expired Info</th>
			  <th>Options</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
</div>
@stop

@push('scripts')
<!-- ChartJS-->	
<script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
  $(function() {
	$('#list-table').DataTable({
	  processing: true,
	  serverSide: true,
	  iDisplayLength: 100,
	  ajax: "{{ url('provinsi/ajax/ktaexpired')}}",
	  columns: [
	    { "data" : "company" },
		{ "data" : "companyrep" },
		{ "data" : "kta"},
		{ "data" : "expired_at"},
		{ "data" : "expired_in"},
		{ "data" : "id_user"},
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

		        	if (row.kta=="") {
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
		  "targets": 2
		},
	    {	    	
		  "render": function ( data, type, row ) {
		  	return '<a href="expired/'+row.id_user+'" class="btn btn-warning btn-xs">'+
		             '<span class="glyphicon glyphicon-search"></span>'+
		             '&nbsp;&nbsp; Detail'+
		           '</a>';
		  },
		  "targets": 5
		},
	  ]
	});
  });
</script>
@endpush