@extends('pusat.app')

@section('active-groupnr')
  active
@stop
@section('active-nrreq')
  active
@stop

@section('content')
  <h1>  </h1>
<div class="col-lg-8">
  <h2>Request National Registration Number</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Indonesia</a>
      </li>      
      <li>
        Request NR Number
      </li>
      <li class="active">
        <strong>Member Detail</strong>        
      </li>
  </ol>
</div>
<div class="col-lg-4">
  <div class="title-action">
    <div class="row">      
      <div class="col-md-6">
        <a href="" class="btn btn-success" data-toggle="modal" data-target="#insertModal" data-id="{{ $member->id }}" data-name="{{ $member->name }}" data-terr="{{ $member->territory }}" data-url="insertkta">
          <span class="glyphicon glyphicon-check"></span>
          &nbsp;&nbsp;Insert NR Number
        </a> 
      </div>
    </div>            
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
            <div class="form-group">
              <label class="col-lg-2 control-label">Username</label>
              <div class="col-lg-10">
                <p class="form-control-static">{{ $member->username }}</p>
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
                <p class="form-control-static">{{ $member->created_at }}</p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Territory</label>
              <div class="col-lg-10">
                <p class="form-control-static">{{ $member->territory_name }}</p>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
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
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
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
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
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
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
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
                  <a href="" class="btn btn-white btn-xs" data-toggle="modal" data-target="#valImgModal" data-id="{{ $row->id }}" data-answer="{{ $row->answer }}" data-question="{{ $row->question }}" data-corr="{{ $row->correction }}" data-comm="{{ $row->commentary }}">
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

<!-- Insert Modal -->
<div class="modal inmodal" id="insertModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content animated bounceInRight">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <i class="fa fa-laptop modal-icon"></i>
    <h4 class="modal-title">Insert NR Number</h4>
    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
    </div>
    <div class="modal-body">
    <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
    printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
    remaining essentially unchanged.</p>
    <div class="text-center">
      <form id="form" method="post" action="{{ url('dashboard/pusat/rn/insertrn/') }}">
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
    <button id="btnNR" type="button" class="btn btn-primary">Insert NR Number</button>
    </div>
  </div>
  </div>
</div>
@stop

@push('scripts')
<!-- Jquery Validate -->
<script src="{{ asset('resources/assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
  $('#insertModal').on('show.bs.modal', function (event) {  
      var button = $(event.relatedTarget) // Button that triggered the modal    
      url = button.data('url');
      id = button.data('id');
      name = button.data('name');
      terr = button.data('terr');

      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();
      var yy = today.getFullYear().toString().substr(2,2);

      today = dd+'-'+mm+'-'+yyyy;
      var forst = yy+mm+dd;
      var fornd = pad(id, 6);

      var modal = $(this);
      modal.find('#st').val(forst);
      modal.find('#nd').val(fornd);
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

    $(document).ready(function(){
          $("#form").validate({
              rules: {
                st: {
                  required: true,
                  minlength: 6,
                  maxlength: 6
                },
                nd: {
                  required: true,
                  minlength: 6,
                  maxlength: 6
                },
                // rd: {
                //     required: true,
                // },
              }
          });

          $('#btnNR').on('click', function (event) {
            var st = $('#st').val();
            var nd = $('#nd').val();
            var rd = $('#rd').val();
            var id_user = $('#id_user').val();
            var kta = st+"-"+nd+"/"+rd;       
            
            var url = "{{ url('dashboard/pusat/rn/insertrn/') }}";

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
                } else {
                  toastr.error(data.msg);
                }

                var ref = $('#list-table').DataTable();
                ref.ajax.reload(null, false);
            });
            }
          });     

        });
</script>
@endpush