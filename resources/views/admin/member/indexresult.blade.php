@extends('common.app')

@section('active-member')
  active
@stop

@section('content')
  <div class="col-lg-10">
    <h2>Detail Member</h2>
    <ol class="breadcrumb">
      <li>
        <a>Admin</a>
      </li>
      <li>
        <a>Member</a>
      </li>
      <li class="active">
        <strong>{{ $member->username }}</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2">
    <div class="title-action">
      <a href='/' class="btn btn-primary" onclick="goBack()">
        <span class="fa fa-arrow-left fa-fw"></span>
        &nbsp;&nbsp;Back
      </a>
    </div>
  </div>
@stop

@section('iframe')
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{{ $member->name }} </h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-12">
              <!-- identitas user -->
              <div class="form-group no-padding">
                <label class="col-lg-2 control-label no-padding">Username</label>
                <div class="col-lg-10">
                  <p class="form-control-static no-padding">{{ $member->username }}</p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-2 control-label no-padding">Tracking Code</label>
                <div class="col-lg-10">
                  <p class="form-control-static no-padding"><?php echo @$detail[0]['trackingcode'];?></p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-2 control-label no-padding">Submitted At</label>
                <div class="col-lg-10">
                  <p class="form-control-static no-padding">{{ $member->created_at }}</p>
                </div>
              </div>
              <div class="form-group no-padding">
                <label class="col-lg-2 control-label no-padding">Territory</label>
                <div class="col-lg-10">
                  <p class="form-control-static no-padding">{{ $member->territory_name }}</p>
                </div>
              </div>              
            </div>
          </div>                
        </div>
      </div>
    </div>
  </div>

  <div class="ibox float-e-margins">
    <div class="ibox-title">    
      <h5>Pendaftaran</h5>    
      <div class="ibox-tools">      
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>
      </div>
    </div>
    <div class="ibox-content" style="display: block;">    
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($detail1->count()>=1)            
            <table class="table">            
              @foreach ($detail1 as $row)
                @if ($row->correction||$row->commentary)
                  <tr bgcolor="#F6CECE">
                @else 
                  <tr>
                @endif
                  <td><strong>{{ $row->question }}</strong></td>
                  <td>:</td>
                  <td>{{ $row->answer }}</td>
                  <td>
                    <a 
                      href="" 
                      class="btn btn-white btn-xs" 
                      data-toggle="modal" 
                      data-target="#valModal" 
                      data-id="{{ $row->id }}" 
                      data-answer="{{ $row->answer }}" 
                      data-question="{{ $row->question }}" 
                      data-corr="{{ $row->correction }}" 
                      data-comm="{{ $row->commentary }}"
                      data-valby="{{ $row->val_by }}" 
                      data-date="{{ $row->validated_at }}">
                      <i class="fa fa-edit fa-fw"></i>
                    </a>
                  </td>
                </tr>
              @endforeach            
            </table>
          @else
            <div class="text-center">
              No Data
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Profile Tahap 2</h5>
      <div class="ibox-tools">      
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>                       
      </div>
    </div>
    <div class="ibox-content" style="display: block;">      
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($detail2->count()>=1)
            <table class="table">              
              @foreach ($detail2 as $row)
                @if ($row->correction||$row->commentary)
                  <tr bgcolor="#F6CECE">
                @else 
                  <tr>
                @endif
                  <td><strong>{{ $row->question }}</strong></td>
                  <td>:</td>
                  <td>{{ $row->answer }}</td>
                  <td>
                    <a 
                    href="" 
                    class="btn btn-white btn-xs" 
                    data-toggle="modal" 
                    data-target="#valModal" 
                    data-id="{{ $row->id }}" 
                    data-answer="{{ $row->answer }}" 
                    data-question="{{ $row->question }}" 
                    data-corr="{{ $row->correction }}" 
                    data-comm="{{ $row->commentary }}"
                    data-valby="{{ $row->val_by }}" 
                    data-date="{{ $row->validated_at }}">
                      <i class="fa fa-edit fa-fw"></i>
                    </a>
                  </td>
                </tr>
              @endforeach              
            </table>
          @else
            <div class="text-center">
              No Data
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Profile Tahap 3</h5>
      <div class="ibox-tools">      
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>                        
      </div>
    </div>
    <div class="ibox-content" style="display: block;">
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($detail3->count()>=1)
            <table class="table">              
              @foreach ($detail3 as $row)
                @if ($row->correction||$row->commentary)
                  <tr bgcolor="#F6CECE">
                @else 
                  <tr>
                @endif
                  <td><strong>{{ $row->question }}</strong></td>
                  <td>:</td>
                  <td>{{ $row->answer }}</td>
                  <td>
                    <a 
                      href="" 
                      class="btn btn-white btn-xs" 
                      data-toggle="modal" 
                      data-target="#valModal" 
                      data-id="{{ $row->id }}" 
                      data-answer="{{ $row->answer }}" 
                      data-question="{{ $row->question }}" 
                      data-corr="{{ $row->correction }}" 
                      data-comm="{{ $row->commentary }}"
                      data-valby="{{ $row->val_by }}" 
                      data-date="{{ $row->validated_at }}">
                      <i class="fa fa-edit fa-fw"></i>
                    </a>
                  </td>
                </tr>
              @endforeach              
            </table>
          @else
            <div class="text-center">
              No Data
            </div>
          @endif
        </div>
      </div>
    </div>    
  </div>
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Documents Uploaded</h5>
      <div class="ibox-tools">      
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>                        
      </div>
    </div>
    <div class="ibox-content" style="display: block;">
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($docs->count()>=1)
            <table class="table">              
              @foreach ($docs as $row)
                @if ($row->correction||$row->commentary)
                  <tr bgcolor="#F6CECE">
                @else 
                  <tr>
                @endif
                  <td><strong>{{ $row->question }}</strong></td>
                  <td>:</td>
                  <td>{{ $row->answer }}</td>
                  <td>
                    <a 
                      href="" 
                      class="btn btn-white btn-xs" 
                      data-toggle="modal" 
                      data-target="#valImgModal" 
                      data-id="{{ $row->id }}" 
                      data-answer="{{ $row->answer }}" 
                      data-question="{{ $row->question }}" 
                      data-corr="{{ $row->correction }}" 
                      data-comm="{{ $row->commentary }}" 
                      data-valby="{{ $row->val_by }}" 
                      data-date="{{ $row->validated_at }}">
                      <i class="fa fa-edit fa-fw"></i>                    
                    </a>
                  </td>
                </tr>
              @endforeach              
            </table>
          @else
            <div class="text-center">
              No Data
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>  
</div>

<!-- Validation Modal -->
<div class="modal inmodal" id="valModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Validation</h4>           
      </div>
      <div class="modal-body">
        <p>Validasi untuk keterangan : </p>      
        <p class="jhgj"></p>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label>Your Correction</label>
          <input type="text" class="form-control" id="correction" readonly>
        </div>
        <div class="form-group">
          <label>Your Commentary</label>
          <textarea class="form-control" id="commentary" readonly></textarea>
        </div>
        <p class="val-by" style="font-size:12px;"></p>
        <p class="val-date" style="font-size:12px;"></p>
      </div>
      <div class="modal-footer">        
      </div>
    </div>
  </div>
</div>

<!-- Validation Modal With Image-->
<div class="modal inmodal" id="valImgModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Validation</h4>           
      </div>
      <div class="modal-body">
        <div class="center-block forimage" align="center">          
        </div>
        <br>
        <p>Validasi untuk keterangan : </p>      
        <p class="jhgj"></p>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label>Your Correction</label>
          <input type="text" class="form-control" id="correctionimg" readonly>
        </div>
        <div class="form-group">
          <label>Your Commentary</label>
          <textarea class="form-control" id="commentaryimg" readonly></textarea>
        </div>
        <p class="val-by" style="font-size:12px;"></p>
        <p class="val-date" style="font-size:12px;"></p>
      </div>
      <div class="modal-footer">        
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script>
  $('#valModal').on('show.bs.modal', function (event) {  
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var question = button.data('question');
    var answer = button.data('answer');
    var corr = button.data('corr');
    var comm = button.data('comm');
    var valby = button.data('valby');
    var date = button.data('date');    

    $(".jhgj").html("<strong>"+question+"  :</strong>  <i>"+answer+"</i>");
    $(".val-by").html("Tervalidasi Oleh : <i>"+valby+"</i>");
    $(".val-date").html("Tervalidasi Tanggal : <i>"+date+"</i>");

    var modal = $(this);
    modal.find('#correction').val(corr);
    modal.find('#commentary').val(comm);    
  });

  $('#valImgModal').on('show.bs.modal', function (event) {  
    var button = $(event.relatedTarget) // Button that triggered the modal          
    id = button.data('id');
    question = button.data('question');
    answer = button.data('answer');
    corr = button.data('corr');
    comm = button.data('comm');
    filename = answer.split(".")[0];
    var valby = button.data('valby');
    var date = button.data('date');

    var uploadedfiles = "{{ url('/uploadedfiles') }}";
    var username = "{{ $member->username }}";

    $(".jhgj").html("<strong>"+question+"  :</strong>  <i>"+answer+"</i>");
    $(".forimage").html("<img src="+uploadedfiles+"/"+username+"_"+filename+" class='img-responsive center-block img-thumbnail' />");
    $(".val-by").html("Tervalidasi Oleh : <i>"+valby+"</i>");
    $(".val-date").html("Tervalidasi Tanggal : <i>"+date+"</i>");
    var modal = $(this);
    modal.find('#correctionimg').val(corr);
    modal.find('#commentaryimg').val(comm);
  });

  function goBack() {
    window.history.back();
  }
</script>
@endpush