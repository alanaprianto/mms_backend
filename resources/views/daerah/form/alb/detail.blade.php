@extends('daerah.app')

@section('active-groupform')
  active
@stop
@section('active-formalb')
  active
@stop

@section('content')
<div class="col-lg-8">
  <h2>Submitted Form Detail</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>        
    <li class="active">
      <strong>Submitted Form Detail</strong>
    </li>
  </ol>
</div>
<div class="col-lg-4">
  <div class="title-action">
    @if ( !$detail[0]['id_user'] )
      <a 
          href="" 
          class="btn btn-success" 
          data-toggle="modal" 
          data-target="#approveModal" 
          data-code="{{ $trcode }}"
          data-name="{{ $name }}">
          
          <span class="glyphicon glyphicon-check"></span>
          &nbsp;&nbsp;Approve User
        </a>

        <a 
          href="" 
          class="btn btn-danger"
          data-toggle="modal" 
          data-target="#myModal" 
          data-code="{{ $trcode }}"
          data-name="{{ $name }}">
          
          <span class="glyphicon glyphicon-trash"></span>
          &nbsp;&nbsp;Delete
        </a>    
    @endif

  </div>
</div>
@stop

@section('iframe')
<div class="row">
  <div class="col-lg-7">
  	<div class="wrapper wrapper-content animated fadeInUp">
      <div class="ibox">
      	<div class="ibox-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="m-b-md">                
                <h3>Detail Submitted Form</h3>
              </div>              
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
	          @if ($detail)
    			    <?php $i=1;?>		
    			    <table class="table">
    			      <tr>
    			        <td><strong>Status</strong></td>
    			      	<td>:</td>
    			      	<td>
                    @if ( $detail[0]['id_user'] )
                      <span class="label label-primary">Registered</span>
                    @else
                      <span class="label label-danger">Not Yet Registered</span>
                    @endif
                  </td>
    			      </tr>
    			      @foreach ($detail as $row)
    			      <tr>
    		            <td><strong>{{ $row->question }}</strong></td>
    			        <td>:</td>
    			        <td>{{ $row->answer }}</td>
    			      </tr>
    			      @endforeach
    			      <tr>
    			        <td><strong>Submitted At</strong></td>
    			      	<td>:</td>
    			      	<td>{{ $detail[0]['created_at'] }}</td>
    			      </tr>
    			    </table>
	          @endif
            </div>
          </div>                                   
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5">                
    <div class="wrapper wrapper-content animated fadeInUp">
      <div class="ibox">
      	<div class="ibox-content">
		      <div class="row">
            <div class="col-lg-12">
              <div class="m-b-md">
                <h3>Payment</h3>
              </div>

              <table class="table table-bordered" id="pay-table" width=100%>
                <thead>
                  <tr>      
                    <th>No</th>
                    <th>Amount</th>
                    <th>Payment Date</th>                    
                  </tr>        
                </thead>
              </table>
            </div>
          </div>                                    
        </div>
      </div>
    </div>
  </div>
</div>
<br/><br/>
<!-- Delete Modal -->
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
      <button id="submit_delete" type="submit" class="btn btn-danger">Delete</button>
      </div>
    </div>
    </div>
  </div>

  <!-- Approve Modal -->
  <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
      <button id="submit_approve" type="submit" class="btn btn-primary">Approve</button>
      </div>
    </div>
    </div>
  </div>
@stop

@push('scripts')  
<script type="text/javascript">      
  $(function() {
    var t = $('#pay-table').DataTable({
      processing: true,
      serverSide: true,
      iDisplayLength: 100,
      aaSorting: [[1, 'desc']],
      bFilter: false, 
      bInfo: false,
      bPaginate: false,
      ajax: "{{ url('daerah/ajax/payment')}}"+"/{{ $detail[0]['trackingcode'] }}",
      columns: [
        { "data" : "id" },
        { "data" : "amount" },
        { "data" : "created_at"},                          
      ],
      "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 2, 'asc' ]]     
    });

    // var t = $('#pay-table').DataTable( {
        
    // } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

  });

  $('#myModal').on('show.bs.modal', function (event) {  
      var button = $(event.relatedTarget) // Button that triggered the modal    
      id = button.data('code');
      name = button.data('name');

      var modal = $(this);
      modal.find('.modal-body').text('Delete Record "' + name + '"?');
      modal.find('.modal-footer .form-control').val(id);

    });

    $('#submit_delete').on('click', function (event) {      
      var url = "{{ url('daerah/submitted/delete/') }}/"+id;

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

          window.location.href = "{{ url('daerah/submitted/alb') }}";
        } else {
          toastr.error(data.msg);
        }        
      });
    });

    $('#approveModal').on('show.bs.modal', function (event) {  
      var button = $(event.relatedTarget) // Button that triggered the modal    
      id = button.data('code');
      name = button.data('name');

      var modal = $(this);
      modal.find('.modal-body').text('Approve Permintaan Menjadi Anggota Luar Biasa dari "' + name + '"?');
      modal.find('.modal-footer .form-control').val(id);

    });

    $('#submit_approve').on('click', function (event) {
      var url = "{{ url('daerah/submitted/alb/approve') }}"

      $.ajax({    
        url: url,
        type: "post",
        data: {         
          _token: "{{ csrf_token() }}",
          trackingcode: id,
        }
      }).done(function(data) {                    
        console.log(data);

        $('#myModal').modal('hide'); 

        if (data.success) {
          toastr.success(data.msg);

          window.location.href = "{{ url('daerah/submitted/alb') }}";
        } else {
          toastr.error(data.msg);
        }        
      });
    });
</script>
@endpush