@extends('daerah.app')

@section('sidebar')
  @include('daerah.form.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Submitted Form</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>        
    <li class="active">
      <strong>Submitted Form</strong>
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
					<h5>{{ count($forms) }} Total Submitted Forms</h5>
					<div class="ibox-tools">
                    	<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
                        </a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a></li>
							<li><a href="#">Config option 2</a></li>
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div>
						<h3 class="m-b-xs"></h3>
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
					<h5>List Submitted Form </h5>
					<div class="ibox-tools">
                    	<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
                        </a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a></li>
							<li><a href="#">Config option 2</a></li>
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
		    aaSorting: [[1, 'desc']],
		    ajax: "{{ url('/dashboard/daerah/ajax/submittedforms')}}",
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
		  var url = "{{ url('dashboard/daerah/submitted/delete/') }}/"+id;

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