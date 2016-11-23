@extends('pusat.app')

@section('sidebar')
	@include('pusat.rn.request.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Request National Registration Number</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Indonesia</a>
      </li>      
      <li class="active">
        <strong>Request NR Number</strong>        
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
		<h5>{{ count($rn) }} Total Request NR Number</h5>
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
		<h5>List Request NR Number</h5>
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
			  <th>Registered At</th>
			  <th>NR Number</th>
			  <th>Options</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
</div>
		
<!-- Insert Modal -->
<div class="modal inmodal" id="insertModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content animated bounceInRight">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<i class="fa fa-laptop modal-icon"></i>
		<h4 class="modal-title">Insert NR Number</h4>
		<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
	  </div>
	  <div class="modal-body">
		<p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
		printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
		remaining essentially unchanged.</p>
		<div class="text-center">
		  <form id="form" method="post" action="{{ url('dashboard/pusat/rn/insertrn/') }}">
			<input type="hidden" id="id_user" name="id_user" value="">
			<input id="st" name="st" type="text" width="124" placeholder="20201">&nbsp;&nbsp;-&nbsp;&nbsp;
			<input id="nd" name="nd" type="text" width="60%" placeholder="12345678">&nbsp;&nbsp;
			<!-- /&nbsp;&nbsp;
			<input id="rd" name="rd" type="text" width="20%" placeholder="7-2-2016" readonly> -->
		  </form>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		<button id="btnNR" type="button" class="btn btn-primary">Insert NR Number</button>
	  </div>
	</div>
  </div>
</div
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
		    ajax: "{{ url('/dashboard/pusat/ajax/rn')}}",
		    columns: [       		      
		      { "data" : "answer" },
		      { "data" : "name" },
		      { "data" : "created_at"},
		      { "data" : "id_user"},
		      { "data" : "id_user"},
		    ],    
		    "columnDefs": [            
		      {		        
		        "render": function ( data, type, row ) {
		        return '<a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#insertModal" data-id="'+row.id_user+'" data-name="'+row.answer+'" data-terr="'+row.territory+'" data-url="insertrn">'+
		        			'<span class="glyphicon glyphicon-check"></span>'+
		        			'&nbsp;&nbsp;Insert NR Number'+
		        		'</a>';
		        },
		        "targets": 3
		      },
		      {		        
		        "render": function ( data, type, row ) {
		        return '<a href="request/'+row.id_user+'" class="btn btn-warning btn-xs">'+
		        			'<span class="glyphicon glyphicon-search"></span>'+
		        			'&nbsp;&nbsp; Detail'+
		        		'</a>';
		        },
		        "targets": 4
		      },		      
		    ]
		  });
		});		

		$('#insertModal').on('show.bs.modal', function (event) {  
		  var button = $(event.relatedTarget) // Button that triggered the modal    
		  url = button.data('url');
		  id = button.data('id');
		  name = button.data('name');
		  terr = button.data('terr');

		  var today = new Date();
		  var dd = today.getDate();
		  var mm = today.getMonth()+1; //January is 0!
		  var yyyy = today.getFullYear();
		  var yy = today.getFullYear().toString().substr(2,2);

		  today = dd+'-'+mm+'-'+yyyy;
		  var forst = yy+mm+dd;
		  var fornd = pad(id, 6);

		  var modal = $(this);
		  modal.find('#st').val(forst);
		  modal.find('#nd').val(fornd);
		  modal.find('#rd').val(today);
		  modal.find('#id_user').val(id);

		  var validator = $("#form").validate();
		  validator.resetForm();
		});		

		function pad(n, width, z) {
		  z = z || '0';
		  n = n + '';
		  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
		}

		$(document).ready(function(){
        	$("#form").validate({
            	rules: {
                     st: {
                         required: true,
                         minlength: 6,
                         maxlength: 6
                     },
                     nd: {
                         required: true,
                         minlength: 6,
                         maxlength: 6
                     },
                     // rd: {
                     //     required: true,
                     // },
                 }
             });

        	$('#btnNR').on('click', function (event) {
			  var st = $('#st').val();
			  var nd = $('#nd').val();
			  var rd = $('#rd').val();
			  var id_user = $('#id_user').val();
			  var kta = st+"-"+nd+"/"+rd;			  
			  
			  var url = "{{ url('dashboard/pusat/rn/insertrn/') }}";

			  if ($("#form").valid()) {
			  	$.ajax({    
					url: url,
				    type: "post",
				    data: {						    	
				    	_token: "{{ csrf_token() }}",
				    	id_user: id_user,
				    	st: st,
				    	nd: nd,
				    	rd: rd,
				    }
				}).done(function(data) {                    
				    console.log(data);

				    $('#insertModal').modal('hide');

				    if (data.success) {
				      toastr.success(data.msg);
				    } else {
				      toastr.error(data.msg);
				    }

				    var ref = $('#list-table').DataTable();
		    		ref.ajax.reload(null, false);
				});
			  }
			});			

        });
    </script>
@endpush