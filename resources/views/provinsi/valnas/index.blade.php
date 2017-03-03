@extends('common.app')

@section('active-valnas')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Validasi Nasional</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
      </li>      
      <li class="active">
        <strong>Validasi Nasional</strong>        
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
          <h5>List Validasi Nasional</h5>
          <div class="ibox-tools"><!-- any link icon --></div>
        </div>
        <div class="ibox-content">
          <table class="table table-striped table-bordered table-hover dataTables-example" id="member-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Member name</th>
                <th>Email</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
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
		  $('#member-table').DataTable({
		    processing: true,
		    serverSide: true,
		    ajax: "{{ url('provinsi/ajax/valnas')}}",
		    columns: [            
		      { "data" : "name" },
		      { "data" : "username" },
		      { "data" : "email" },        
		      { "data" : "id"}    
		    ],
		    "columnDefs": [            
		      {
		        // The `data` parameter refers to the data for the cell (defined by the
		        // `data` option, which defaults to the column being worked with, in
		        // this case `data: 0`.
		        // <a href="member/'+row.id+'/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a>
		        "render": function ( data, type, row ) {
		        return '<a href="valnas/'+row.id+'" class="btn btn-warning btn-xs">'+
		                  'Detail'+
		                '</a>';
		        },
		        "targets": 3
		      },
		      // {        
		      //   "render": function ( data, type, row ) {
		      //   return '<p>"'+row.html_tag+'"</p>';
		      //   },
		      //   "targets": 2
		      // }
		    ]
		  });
		});
    </script>
@endpush