@extends('provinsi.app')

@section('active-groupkta')
  active
@stop
@section('active-ktaext')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>KTA Extension Request</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
      </li>        
      <li class="active">
        <strong>KTA Extension Request</strong>
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
        <h5>List KTA Extension Request</h5>
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
              <th>KTA</th>
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
<script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('resources/assets/js/plugins/validate/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
  $(function() {
    $('#list-table').DataTable({
      processing: true,
      serverSide: true,
      iDisplayLength: 100,
      ajax: "{{ url('provinsi/ajax/ktaext')}}",
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
          return '<a href="extension/'+row.id_user+'" class="btn btn-warning btn-xs">'+
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