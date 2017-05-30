@extends('common.app')

@section('active-groupmember')
  active
@stop
@section('active-memberalb')
  active
@stop

@section('content')
@php
  if (Auth::user()->role==1) {
    $breadcrumb = "Admin";
  } else if (Auth::user()->role==5) {
    $breadcrumb = "Kadin Daerah";
  } else {
    $breadcrumb = "-";
  }
@endphp
<div class="col-lg-6">
  <h2>Member Detail</h2>
  <ol class="breadcrumb">
    <li>
      <a>{{ $breadcrumb }}</a>
    </li>        
    <li class="active">
      <strong>Extraordinary Member Detail</strong>
    </li>
  </ol>
</div>
<div class="col-lg-6">
  <div class="title-action">
    @if($member->kta->first())
      @if($member->kta->first()->kta=="requested")
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#reqModal" data-id="{{ $member->id }}">
          <span class="glyphicon glyphicon-check"></span>
          &nbsp;&nbsp;Request KTA
        </a>
        @if($notes>0)
          <a href="" class="btn btn-danger" data-toggle="modal" data-target="#postModal" data-id="{{ $member->id }}">
            <span class="glyphicon glyphicon-check"></span>
            &nbsp;&nbsp;Postpone Request
          </a>
        @endif
      @endif
    @endif
    <a href='/' class="btn btn-primary" onclick="goBack()">
      <span class="fa fa-arrow-left fa-fw"></span>
      &nbsp;&nbsp;Back
    </a>
  </div>
</div>
@stop

@section('iframe')
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
        </div>
        <br><br><br><br><br><br><br>
        <div class="col-lg-12" style="margin-right:10px;margin-left:10px;">
          @if (count($detail)>=1)
            <table class="table">
              @foreach ($detail as $row)
                @if ($row->correction||$row->commentary)
                  <tr bgcolor="#F6CECE">
                @else
                  <tr>
                @endif
                  <td><strong>{{ $row->question }}</strong></td>
                  <td>:</td>
                  <td>{{ $row->answer }}</td>
                  <td>
                    @if (in_array($row->id_question, $fileq))
                      <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valImgModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
                        <i class="fa fa-edit fa-fw"></i>
                      </a>
                    @else
                      <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
                        <i class="fa fa-edit fa-fw"></i>
                      </a>
                    @endif
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
<div class="row">
</div>
<br/><br/>
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
          <input type="text" class="form-control" id="correction">
        </div>
        <div class="form-group">
          <label>Your Commentary</label>
          <textarea class="form-control" id="commentary"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
        <button id="validate" type="button" class="btn btn-primary">Validasi</button>
      </div>
    </div>
  </div>
</div>
<br/><br/>
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
        <p style="text-align:left;">
        Validasi untuk keterangan : 
        <span style="float:right;">
          <a target="_blank" href="" id="dl-link">
            Download File
          </a>
        </span>
        </p>
        
        <p class="jhgj"></p>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label>Your Correction</label>
          <input type="text" class="form-control" id="correctionimg">
        </div>
        <div class="form-group">
          <label>Your Commentary</label>
          <textarea class="form-control" id="commentaryimg"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
        <button id="validateimg" type="button" class="btn btn-primary">Validasi</button>
      </div>
    </div>
  </div>
</div>

<!-- Request Modal -->
<div class="modal inmodal" id="reqModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content animated bounceInRight">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>           
      <h4 class="modal-title">Confirm</h4>
    </div>
    <div class="modal-body">
      <p class="thetext"></p>  
      <p>Lanjutkan request KTA ke kadin Provinsi?</p>    
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
      <button id="lanjutkan" type="button" class="btn btn-primary">Lanjutkan</button>
    </div>
  </div>
  </div>
</div>

<!-- Postpone Modal -->
<div class="modal inmodal" id="postModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Confirm</h4>
      </div>
      <div class="modal-body">
        <p class="thetext"></p>
        <p>Postpone request KTA untuk diperbaiki Member?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
        <button id="postpone" type="button" class="btn btn-danger">Lanjutkan</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
	<!-- ChartJS-->	
  <script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
  <script type="text/javascript">		
    $('#valModal').on('show.bs.modal', function (event) {  
      var button = $(event.relatedTarget) // Button that triggered the modal
      id = button.data('id');
      question = button.data('question');
      answer = button.data('answer');
      corr = button.data('corr');
      comm = button.data('comm');

      $(".jhgj").html("<strong>"+question+"  :</strong>  <i>"+answer+"</i>");

      var modal = $(this);
      if (corr) {
        modal.find('#correction').val(corr);
      }
      if (comm) {
        modal.find('#commentary').val(comm);
      }
    });

    $('#validate').on('click', function (event) {      
      correction = document.getElementById('correction').value;
      commentary = document.getElementById('commentary').value;

      $.ajax({
          url: "{{ url('common/member/validate') }}/"+id,
          type: "post",
          data: {              
            _token: "{{ csrf_token() }}",
            correction: correction,
            commentary: commentary,            
          }
        }).done(function(data) {
          console.log(data);

          if (data.success) {
            toastr.success(data.msg);
          } else {
            toastr.error(data.msg);
          }          

          $('#valModal').modal('hide');

          setTimeout(location.reload.bind(location), 1000);
        });
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

      $(".jhgj").html("<strong>"+question+"  :</strong>  <i>"+answer+"</i>");
      $(".forimage").html("<img src="+imgsrc+" class='img-responsive center-block img-thumbnail' />");
      var modal = $(this);      
      if (corr) {
        modal.find('#correctionimg').val(corr);      
      }
      if (comm) {
        modal.find('#commentaryimg').val(comm);      
      }

      var uname = "{{ $member->username }}";      
      var link = document.getElementById("dl-link");
      link.setAttribute('href', "{{ url('storage/app/uploadedfiles') }}/"+uname+"/"+answer);

    });

    $('#validateimg').on('click', function (event) {      
      correction = document.getElementById('correctionimg').value;
      commentary = document.getElementById('commentaryimg').value;

      $.ajax({
          url: "{{ url('common/member/validate') }}/"+id,
          type: "post",
          data: {              
            _token: "{{ csrf_token() }}",
            correction: correction,
            commentary: commentary,            
          }
        }).done(function(data) {
          console.log(data);

          if (data.success) {
            toastr.success(data.msg);
          } else {
            toastr.error(data.msg);
          }          

          $('#valImgModal').modal('hide');

          setTimeout(location.reload.bind(location), 1000);
        });
    });

    var idreq = 0;
    $('#reqModal').on('show.bs.modal', function (event) {  
      var button = $(event.relatedTarget) // Button that triggered the modal          
      idreq = button.data('id');

      notes = "{{$notes}}";
      var modal = $(this);
      if (notes>=1) {
        $(".thetext").html("<strong>Perhatian!! :</strong> Member ini memiliki "+notes+" catatan");        
      }

    });

    $('#postModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        idreq = button.data('id');

        notes = "{{$notes}}";
        if (notes>=1) {
            $(".thetext").html("Member ini memiliki "+notes+" catatan");
        }
    });

    $('#lanjutkan').on('click', function (event) {            
      note = "{{ $notes }} catatan";

      $.ajax({
          url: "{{ url('common/member/requestkta') }}",
          type: "post",
          data: {              
            _token: "{{ csrf_token() }}",        
            id_user: idreq,
            keterangan: note    
          }
        }).done(function(data) {
          console.log(data);

          if (data.success) {
            toastr.success(data.msg);

            window.location.href = "{{ url('common/member/alb') }}";
          } else {
            toastr.error(data.msg);
            
            $('#reqModal').modal('hide');
          }          

        });
    });

    $('#postpone').on('click', function (event) {
        note = "{{ $notes }} catatan";

        $.ajax({
            url: "{{ url('common/member/postponekta') }}",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                id_user: idreq,
                keterangan: note
            }
        }).done(function(data) {
            console.log(data);

            if (data.success) {
                toastr.success(data.msg);

                window.location.href = "{{ url('common/member/alb') }}";
            } else {
                toastr.error(data.msg);

                $('#reqModal').modal('hide');
            }

        });
    });
    function goBack() {
        window.history.back();
    }
  </script>
@endpush