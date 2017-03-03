@extends('common.app')

@section('active-compprof')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Company Profile</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li class="active">
      <strong>Company Profile</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>User Profile</h5>
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
              <p class="form-control-static no-padding">{{ $trackingcode }}</p>
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
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">    
      <h5>Pendaftaran -</h5>&nbsp;&nbsp;
      @if ($show)
        <a href="{{ url('member/completeprofile') }}/{{ $qg1->id }}">
          <i class="fa fa-gear"></i>
          Edit
        </a>
      @endif
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
              <tr>
                <td><strong>Status</strong></td>
                <td>:</td>
                <td>
                  @if ( $detail1[0]['id_user'] )
                    <span class="label label-primary">Registered</span>
                  @else
                    <span class="label label-danger">Not Yet Registered</span>
                  @endif
                </td>
              </tr>
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
                <h4>No Data</h4>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Profile Tahap 2 -</h5>&nbsp;&nbsp;
      @if ($show)
        <a href="{{ url('member/completeprofile') }}/{{ $qg2->id }}">
          <i class="fa fa-gear"></i>
          Edit
        </a>
      @endif
      <div class="ibox-tools">      
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>                       
      </div>
    </div>
    <div class="ibox-content" style="display: block;">      
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($detail2)
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
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Profile Tahap 3 -</h5>&nbsp;&nbsp;
      @if ($show)
        <a href="{{ url('member/completeprofile') }}/{{ $qg3->id }}">
          <i class="fa fa-gear"></i>
          Edit
        </a>
      @endif
      <div class="ibox-tools">
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>                        
      </div>
    </div>
    <div class="ibox-content" style="display: block;">
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($detail3)
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
          @endif
        </div>
      </div>
    </div>    
  </div>
</div>
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Documents Uploaded -</h5>&nbsp;&nbsp;
      @if ($show)
        <a href="{{ url('member/completeprofile') }}/{{ $qgd->id }}">
          <i class="fa fa-gear"></i>
          Edit
        </a>
      @endif
      <div class="ibox-tools">
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
        </a>
      </div>
    </div>
    <div class="ibox-content" style="display: block;">
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">
          @if ($docs)
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
          @endif
        </div>
      </div>
    </div>    
  </div>
</div>
<div class="row">
  
</div>
<br><br>
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
          <label>Correction</label>
          <input type="text" class="form-control" id="correction" readonly>
        </div>
        <div class="form-group">
          <label>Commentary</label>
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
          <label>Correction</label>
          <input type="text" class="form-control" id="correctionimg" readonly>
        </div>
        <div class="form-group">
          <label>Commentary</label>
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
<script type="text/javascript">
    $(document).ready(function(){
        loadTable("profile-table", "{{ url('profile/indexAjax/')}}"+"/"+"{{ Auth::user()->id }}");
        loadTable("tahap2-table", "{{ url('profile/tahapiiAjax/')}}"+"/"+"{{ Auth::user()->id }}");
        loadTable("tahap3-table", "{{ url('profile/tahapiiiAjax/')}}"+"/"+"{{ Auth::user()->id }}");
    });

    function loadTable(id, url) {
        $('#'+id).DataTable({
            processing: true,
            serverSide: true,
            sDom: 'rt',
            bSort: false,
            ajax: url,
            columns: [       
              { "data" : "question" },          
              { "data" : "answer" },                  
            ],
          });
    }

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
    filename = filename.replace(/\s+/g, "%20");

    var uploadedfiles = "{{ url('/uploadedfiles') }}";
    var username = "{{ $member->username }}";
    var imgsrc = uploadedfiles+"/"+username+":::"+filename;
    
    var valby = button.data('valby');
    var date = button.data('date');

    var uploadedfiles = "{{ url('/uploadedfiles') }}";
    var username = "{{ $member->username }}";

    $(".jhgj").html("<strong>"+question+"  :</strong>  <i>"+answer+"</i>");
    $(".forimage").html("<img src="+imgsrc+" class='img-responsive center-block img-thumbnail' />");
    $(".val-by").html("Tervalidasi Oleh : <i>"+valby+"</i>");
    $(".val-date").html("Tervalidasi Tanggal : <i>"+date+"</i>");
    var modal = $(this);
    modal.find('#correctionimg').val(corr);
    modal.find('#commentaryimg').val(comm);
  });
</script>
@endpush