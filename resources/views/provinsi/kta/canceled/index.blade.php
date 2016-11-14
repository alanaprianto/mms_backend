@extends('provinsi.app')

@section('sidebar')
	@include('provinsi.kta.canceled.sidebar')
@stop

@section('content')	
<div class="col-lg-10">
  <h2>Canceled KTA Request</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
      </li>        
      <li class="active">
        <strong>Canceled KTA Request</strong>
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
                	<h5>{{ count($kta) }} Total Request KTA Cancelled</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a>
							</li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div>
						<h2 class="m-b-xs"></h2>
						<!-- <span class="pull-right text-right">
							<small>Average value of sales in the past month in: <strong>United states</strong></small>
							<br/>
							All sales: 162,862
						</span>
						<h1 class="m-b-xs">$ 50,992</h1>
						<h3 class="font-bold no-margins">
							Half-year revenue margin
						</h3>
						<small>Sales marketing.</small> -->
					</div>
					<div>
						<canvas id="lineChart" height="70"></canvas>
					</div>
					<div class="m-t-md">
						<!-- <small class="pull-right">
							<i class="fa fa-clock-o"> </i>
							Update on 16.07.2015
						</small>
						<small>
							<strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
						</small> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
    	<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
                	<h5>List Cancelled Request KTA</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a>
							</li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<table class="table table-bordered" id="list-table" width=100%>
						<thead>
							<tr>
								<th>Company</th>
								<th>Registered At</th>
								<th>Cancelled At</th>
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
		    ajax: "{{ url('/dashboard/provinsi/ajax/ktacancelled')}}",
		    columns: [       		      
		      { "data" : "answer" },     
		      { "data" : "created_at"},                  
		      { "data" : "updated_at"},            
		      { "data" : "id_user"},
		    ],    
		    "columnDefs": [            
		      {		        
		        "render": function ( data, type, row ) {
		        return '<a href="cancel/'+row.id_user+'" class="btn btn-warning btn-xs">'+
		        			'<span class="glyphicon glyphicon-search"></span>'+
		        			'&nbsp;&nbsp; Detail'+
		        		'</a>'+
		        		'&nbsp;&nbsp;';
		        },
		        "targets": 3
		      },		      
		    ]
		  });
		});
    </script>
@endpush