@extends('common.app')

@section('active-groupkta')
	active
@stop
@section('active-ktalist')
	active
@stop

@section('content')
<div class="col-lg-10">
  <h2>List KTA</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
      </li>
      <li>
        <a>KTA</a>
      </li>
      <li class="active">
        <strong>List KTA</strong>        
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
		<h5>List KTA</h5>
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
			  <th>Registered At</th>
			  <th>Granted At</th>
			  <th>KTA</th>
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
		    ajax: "{{ url('provinsi/ajax/ktalist')}}",
		    columns: [
		      { "data" : "answer" },
		      { "data" : "created_at"},
		      { "data" : "granted_at"},
		      { "data" : "kta"},
		      { "data" : "id_user"},
		    ],
		    "columnDefs": [
		      {
		        "render": function ( data, type, row ) {
		        return '<a href="list/'+row.id_user+'" class="btn btn-warning btn-xs">'+
		        			'<span class="glyphicon glyphicon-search"></span>'+
		        			'&nbsp;&nbsp; Detail'+
		        		'</a>';
		        },
		        "targets": 4
		      },		      
		    ]
		  });
		});
    </script>
@endpush