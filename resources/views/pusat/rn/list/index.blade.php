@extends('pusat.app')

@section('active-groupnr')
	active
@stop
@section('active-nrlist')
	active
@stop

@section('content')
<div class="col-lg-10">
  <h2>List National Registration Number</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Indonesia</a>
      </li>      
      <li class="active">
        <strong>List National Registration Number</strong>        
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
        <h5>{{ count($rn) }} Total National Registration Number</h5>
		<div class="ibox-tools">
		  <div class="btn-group">
			<button type="button" class="btn btn-xs btn-white">Today</button>
			<button type="button" class="btn btn-xs btn-white ">Monthly</button>
			<button type="button" class="btn btn-xs btn-white active">Annual</button>
		  </div>
		  &nbsp;&nbsp;
		  <a class="collapse-link">
			<i class="fa fa-chevron-up"></i>
		  </a>
		</div>
	  </div>
	  <div class="ibox-content">
		<div>
		  <h2 class="m-b-xs"></h2>						
	    </div>
	    <div>
  		  <canvas id="lineChart" height="70"></canvas>
	    </div>
	    <div class="m-t-md">						
	    </div>
	  </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
	<div class="ibox float-e-margins">
	  <div class="ibox-title">
		<h5>List National Registration Number</h5>
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
			  <th>NR Number</th>
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
    <script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
    <!-- Jquery Validate -->
    <script src="{{ asset('resources/assets/js/plugins/validate/jquery.validate.min.js') }}"></script>

    <script type="text/javascript">
    	$(function () {
    		var l = [@foreach($labels as $k => $value)
					   '{{ $value }}',
					@endforeach ];
			var d = [@foreach($data as $k => $value)
					   '{{ $value }}',
					@endforeach ];

		    var lineData = {
		        labels: l,
		        datasets: [		            
		            {
		                label: "Example dataset",
		                fillColor: "rgba(26,179,148,0.5)",
		                strokeColor: "rgba(26,179,148,0.7)",
		                pointColor: "rgba(26,179,148,1)",
		                pointStrokeColor: "#fff",
		                pointHighlightFill: "#fff",
		                pointHighlightStroke: "rgba(26,179,148,1)",
		                data: d 
		            }
		        ]
		    };

		    var lineOptions = {
		        scaleShowGridLines: true,
		        scaleGridLineColor: "rgba(0,0,0,.05)",
		        scaleGridLineWidth: 1,
		        bezierCurve: true,
		        bezierCurveTension: 0.4,
		        pointDot: true,
		        pointDotRadius: 4,
		        pointDotStrokeWidth: 1,
		        pointHitDetectionRadius: 20,
		        datasetStroke: true,
		        datasetStrokeWidth: 2,
		        datasetFill: true,
		        responsive: true,
		    };


		    var ctx = document.getElementById("lineChart").getContext("2d");
		    var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
		});

		$(function() {
		  $('#list-table').DataTable({
		    processing: true,
		    serverSide: true,
		    iDisplayLength: 100,
		    ajax: "{{ url('pusat/ajax/rn/list')}}",
		    columns: [       		      
		      { "data" : "answer" },     
		      { "data" : "created_at"},                  
		      { "data" : "granted_at"},
		      { "data" : "regnum"},
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