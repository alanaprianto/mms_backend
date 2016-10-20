@extends('provinsi.app')

@section('sidebar')
	@include('provinsi.kta.request.sidebar')
@stop

@section('content')
	<h1> Member Detail </h1>
@stop

@section('iframe')	
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $member->name }} </h5>
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
                                <th>Question</th>
                                <th>Answer Value</th>
							    <th>User</th>
							    <th>Tracking Code</th>      
							    <th>Submitted At</th>
							</tr>      
                        </thead>
                    </table>
                </div>
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
		    ajax: "{{ url('/dashboard/daerah/ajax/members/')}}/{{ $member->id }}",
		    columns: [       
		    	{ "data" : "question" },        
		        { "data" : "answer" },        
		        { "data" : "name"},        
		        { "data" : "trackingcode"},      
		        { "data" : "created_at"},      
		    ],		    
		  });
		});
    </script>
@endpush