@extends('form.app')

@section('sidebar')
  @include('form.member.sidebar')
@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Detail Member</h2>
    <ol class="breadcrumb">
        <li>
            <a>Member</a>
        </li>
        <li>
            <a>Detail</a>
        </li>
        <li class="active">
            <strong>{{ $member->username }}</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a href='/' class="btn btn-primary"><span class="fa fa-arrow-left fa-fw"></span>&nbsp;&nbsp;Back</a>
    </div>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Detail User</h5>
          <div class="ibox-tools"><!-- any link icon --></div>
        </div>
        <div class="ibox-content">
          <form class="form-horizontal">
            <!-- identitas user -->
            <div class="form-group">
              <label class="col-lg-2 control-label">User</label>
              <div class="col-lg-10">
                <p class="form-control-static"><?php echo @$detail[0]['username'];?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Tracking Code</label>
              <div class="col-lg-10">
                <p class="form-control-static"><?php echo @$detail[0]['trackingcode'];?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Submitted At</label>
              <div class="col-lg-10">
                <p class="form-control-static"><?php echo @$detail[0]['created_at'];?></p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group">
              <label class="col-lg-2 control-label">Questions</label>
              <div class="col-lg-10">
                <p class="form-control-static">
                  <strong>Found <?php echo count(@$detail);?> questions.</strong>
                  <div class="table-responsive">
                    <table class="table table-hover issue-tracker">
                      <tbody>
                        @if ($detail)
                        <?php $i=1;?>
                        @foreach ($detail as $row)
                        <tr>
                          <td><span class="label label-primary">added</span></td>
                          <td class="issue-info"><a href="#">QUESTION-<?php echo str_pad($i++, 1, '0', STR_PAD_LEFT);?></a><small>{{ $row->question }}</small></td>
                          <td align="right">{{ $row->answer }}</td>
                          <td class="text-right">
                            <button class="btn btn-white btn-xs" title="Edit Question"> <i class="fa fa-edit fa-fw"></i></button>
                            <button class="btn btn-white btn-xs" title="Delete Question"> <i class="fa fa-trash fa-fw"></i></button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </p>
              </div>
            </div>
          </form>

        </div>
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
  var urlAjax = "{{ url('crud/form/ajax/memberresultAjax/')}}/{{ $member->id }}";
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
    var ajax = urlAjax;
    console.log(ajax);

    $('#result-table').DataTable({
      processing: true,
      serverSide: true,
      iDisplayLength: 50,
      ajax: ajax,
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