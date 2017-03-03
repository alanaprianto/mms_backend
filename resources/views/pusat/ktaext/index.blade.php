@extends('common.app')

@section('active-ktaext')
	active
@stop

@section('content')
<div class="col-lg-10">
  <h2>KTA Extension Request</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Indonesia</a>
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
              <th>Status</th>
              <th>Options</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Process Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        ASDAD          
      </div>
      <div class="modal-footer">
        <input type="hidden" class="form-control" id="id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="proceed" type="submit" class="btn btn-primary">Proceed</button>
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
      ajax: "{{ url('pusat/ajax/ktaext')}}",
      columns: [
        { "data" : "company" },
        { "data" : "companyrep" },
        { "data" : "kta"},
        { "data" : "expired_at"},
        { "data" : "expired_in"},
        { "data" : "status"},
        { "data" : "id_user"},
      ],    
      "columnDefs": [
        {           
          "render": function ( data, type, row ) {     
            if (row.status=="request_perpanjangan") {
              return 'Not Yet Processed';
            } else {
              return 'Processed';
            }                
          },
          "targets": 3
        },
        {
          "render": function ( data, type, row ) {
            return '<a href="ktaextprocess/'+row.id+'" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" data-id="'+row.id+'" data-name="'+row.company+'">'+
                     '<span class="glyphicon glyphicon-search"></span>'+
                     '&nbsp;&nbsp; Process Request'+
                   '</a>'+
                   '&nbsp;'+
                   '<a href="ktaext/'+row.id_user+'" class="btn btn-warning btn-xs">'+
                     '<span class="glyphicon glyphicon-search"></span>'+
                     '&nbsp;&nbsp; Detail'+
                   '</a>';
          },
          "targets": 6
        },
      ]
    });
  });

  $('#myModal').on('show.bs.modal', function (event) {  
    var button = $(event.relatedTarget) // Button that triggered the modal        
    id = button.data('id');
    name = button.data('name');    

    var modal = $(this);
    modal.find('.modal-body').text('Proceed KTA Extension Request from ' + name + '?');

  });

  $('#proceed').on('click', function (event) {      
    var url = "{{ url('pusat/ktaext/process') }}";
            
    $.ajax({
      url: url,
      type: "post",
      data: {          
        _token: "{{ csrf_token() }}",
        id_kta: id,
        compname: name,
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