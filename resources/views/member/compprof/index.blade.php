@extends('member.app')

@section('sidebar')
  @include('member.compprof.sidebar')
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
      <div>
        <table class="table" id="profile-table" width=100%>                                                     
        </table>
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
      <div>
        <table class="table" id="tahap2-table" width=100%>                                                     
        </table>
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
      <div>
        <table class="table" id="tahap3-table" width=100%>                                                     
        </table>
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
</script>
@endpush