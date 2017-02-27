@extends('daerah.app')

@section('sidebar')
  @include('daerah.sidebar-plain')
@stop

@section('content')
  <div class="col-lg-10">
    <h1> Submitted Form </h1>
  </div>
@endsection

@section('iframe')
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-content">
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($detail->count()>0)
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
          @else
            <div class="text-center">
              <h4>No Data</h4>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
</div>
<br/><br/>
<!-- <table class="table table-bordered" id="result-table" width=100%>
  <thead>
    <tr>      
      <th>Question</th>                  
      <th>Answer Value</th>        
      <th>Submitted At</th>  
      <th>Tracking Code</th>      
    </tr>        
  </thead>
</table> -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        Delete Record No 
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
<script>
$('#myModal').on('show.bs.modal', function (event) {  
  var button = $(event.relatedTarget) // Button that triggered the modal    
  url = button.data('url');
  id = button.data('id');
  name = button.data('name');

  console.log(url + " " + id + " " + name);

  var modal = $(this);
  modal.find('.modal-body').text('Delete Record "' + name + '"?');
  modal.find('.modal-footer .form-control').val(id);

});

$('#submit_delete').on('click', function (event) {
  console.log("submit clicked");
  console.log(url+"/"+id);    

  $.ajax({    
    url: url+"/"+id,
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

    var ref = $('#result-table').DataTable();
    ref.ajax.reload(null, false);    
  });
});

$(function() {
  $('#result-table').DataTable({
    processing: true,
    serverSide: true,
    iDisplayLength: 50,
    ajax: "{{ url('daerah/ajax/notifresult/')}}/{{ $code }}",
    columns: [       
      { "data" : "question" },      
      { "data" : "answer" },     
      { "data" : "created_at"},                  
      { "data" : "trackingcode"},            
    ],    
  });
});

</script>
@endpush