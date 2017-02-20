@extends('provinsi.app')

@section('active-groupkta')
    active
@stop

@section('content') 
<div class="col-lg-8">
  <h2>Member Detail</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
      </li>        
      <li>
        KTA
      </li>
      <li class="active">
        <strong>Member Detail</strong>        
      </li>
  </ol>
</div>
<div class="col-lg-4">
  <div class="title-action">
    @if($member->kta->first())
      @if($member->kta->first()->kta=="validated")
        <a 
          href="" 
          class="btn btn-success" 
          data-toggle="modal" 
          data-target="#insertModal" 
          data-id="{{ $member->id }}"
          data-name="{{ $member->name }}"
          data-terr="{{ $member->territory }}"
          data-pp="{{ $member->kta->first()->perpanjangan }}">
          
          <span class="glyphicon glyphicon-check"></span>
          &nbsp;&nbsp;Insert KTA
        </a>

        <a 
          href="" 
          class="btn btn-danger"
          data-toggle="modal" 
          data-target="#cancelModal" 
          data-id="{{ $member->id }}" 
          data-name="{{ $member->name }}">
          
          <span class="glyphicon glyphicon-trash"></span>
          &nbsp;&nbsp;Cancel Request
        </a>
      @endif
    @endif    
  </div>
</div>
@stop

@section('iframe')  
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>{{ $member->kta->first()->kta }} </h5>
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

<!-- Insert Modal -->
<div class="modal inmodal" id="insertModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content animated bounceInRight">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
      <span aria-hidden="true">&times;</span>
      <span class="sr-only">Close</span>
    </button>
    <i class="fa fa-laptop modal-icon"></i>
    <h4 class="modal-title">Insert KTA</h4>
    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
    </div>
    <div class="modal-body">
    <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
    printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
    remaining essentially unchanged.</p>
    <div class="text-center">
      <form id="form" method="post" action="{{ url('provinsi/kta/insertkta/') }}">
      <input type="hidden" id="id_user" name="id_user" value="">
      <input id="st" name="st" type="text" width="124" placeholder="20201">&nbsp;&nbsp;-&nbsp;&nbsp;
      <input id="nd" name="nd" type="text" width="60%" placeholder="12345678">&nbsp;&nbsp;
      <!-- /&nbsp;&nbsp;
      <input id="rd" name="rd" type="text" width="20%" placeholder="7-2-2016" readonly> -->
      </form>
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    <button id="btnKTA" type="button" class="btn btn-primary">Insert KTA</button>
    </div>
  </div>
  </div>
</div>

<!-- Cancel KTA Request Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
    </div>
    <div class="modal-body">
    <p class="jhgj"></p>
    <div class="form-group">
      <label>Silahkan cantumkan keterangan</label>
      <form id="formcancel" method="post" action="{{ url('provinsi/kta/cancelkta/a') }}">
      <input type="hidden" id="id_usercancel" name="id_usercancel" value="">
      <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
      </form>
    </div>
    </div>
    <div class="modal-footer">
    <input type="hidden" class="form-control" id="id">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button id="batalkan" type="submit" class="btn btn-danger">Batalkan</button>
    </div>
  </div>
  </div>
</div>
@stop

@push('scripts')
<!-- Jquery Validate -->
<script src="{{ asset('resources/assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
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

  $('#insertModal').on('show.bs.modal', function (event) {  
    var button = $(event.relatedTarget) // Button that triggered the modal      
    id = button.data('id');
    name = button.data('name');
    terr = button.data('terr');
    thkta = button.data('pp');

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    var yy = today.getFullYear().toString().substr(2,2);

    today = dd+'-'+mm+'-'+yyyy;
    var fornd = yy+pad(id, 6);

    var modal = $(this);
            
    if (thkta&&thkta.indexOf("processed") !== -1) {
      var kta1 = thkta.split("_");
      var kta = kta1[1].split("-");
      modal.find('#st').val(kta[0]);
      modal.find('#nd').val(kta[1]);
    } else {      
      modal.find('#st').val(terr);
      modal.find('#nd').val(fornd);
    }     
    modal.find('#rd').val(today);
    modal.find('#id_user').val(id);

    var validator = $("#form").validate();
    validator.resetForm();
  });   

  function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
  }

  $('#cancelModal').on('show.bs.modal', function (event) {  
    var button = $(event.relatedTarget) // Button that triggered the modal
    id = button.data('id');
    name = button.data('name');

    var modal = $(this);
    modal.find('#keterangan').val("");
    modal.find('#id_usercancel').val(id);
    $(".jhgj").html('Batalkan Permintaan Nomor KTA dari "' + name + '"?');
    modal.find('.modal-footer .form-control').val(id);

    var validator = $("#formcancel").validate();
    validator.resetForm();
  });

  $(document).ready(function(){
    $("#form").validate({
      rules: {
        st: {
          required: true,
          minlength: 5,
          maxlength: 5
        },
        nd: {
          required: true,
          minlength: 8,
          maxlength: 8
        },
        rd: {
          required: true,
        },
      }
    });

    $("#formcancel").validate({
      rules: {
        keterangan: {
          required: true,
          minlength: 5
        },
      }
    });

    $('#btnKTA').on('click', function (event) {
      var st = $('#st').val();
      var nd = $('#nd').val();
      var rd = $('#rd').val();
      var id_user = $('#id_user').val();
      var kta = st+"-"+nd+"/"+rd;       
        
      var url = "{{ url('provinsi/kta/insertkta/') }}";

      if ($("#form").valid()) {
        $.ajax({    
          url: url,
            type: "post",
            data: {                 
              _token: "{{ csrf_token() }}",
              id_user: id_user,
              st: st,
              nd: nd,
              rd: rd,
            }
        }).done(function(data) {
          console.log(data);

          $('#insertModal').modal('hide');

          if (data.success) {
            toastr.success(data.msg);

            window.location.href = "{{ url('provinsi/kta/request') }}";
          } else {
            toastr.error(data.msg);

            $('#insertModal').modal('hide');
          }          
        });
      }
    });     

    $('#batalkan').on('click', function (event) {
      var id_user = $('#id_usercancel').val();
      var keterangan = $('#keterangan').val();

      var url = "{{ url('provinsi/kta/cancelkta/') }}";  

      if ($("#formcancel").valid()) {
        $.ajax({    
          url: url,
            type: "post",
            data: {
              _token: "{{ csrf_token() }}",
              id_user: id_user,
              keterangan : keterangan,
            }
        }).done(function(data) {
          console.log(data);

          $('#cancelModal').modal('hide');

          if (data.success) {
            toastr.success(data.msg);

            window.location.href = "{{ url('provinsi/kta/request') }}";
          } else {
            toastr.error(data.msg);

            $('#cancelModal').modal('hide');
          }          
        });
      }
    });
  });
</script>
@endpush