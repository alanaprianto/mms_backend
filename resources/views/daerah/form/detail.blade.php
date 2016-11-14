@extends('daerah.app')

@section('head')
<style type="text/css">
	.col-centered{
	    float: none;
	    margin: 0 auto;
	}
</style>
@stop

@section('sidebar')
  @include('daerah.form.sidebar')
@stop

@section('content')
<div class="col-lg-10">
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
<div class="col-lg-2">
  <div class="title-action">      
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
            <div class="col-lg-9 col-lg-offset-1">
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
      ajax: "{{ url('/dashboard/daerah/ajax/payment')}}"+"/{{ $detail[0]['trackingcode'] }}",
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
</script>
@endpush