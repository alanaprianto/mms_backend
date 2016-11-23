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
      <a href="{{ url('member/completeprofile') }}/{{ $qg1->id }}">
        Edit
      </a>
      &nbsp;&nbsp;
      <a class="collapse-link">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content" style="display: block;">
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
            <p class="form-control-static">{{ $detail1[0]['trackingcode'] }}</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Submitted At</label>
          <div class="col-lg-10">
            <p class="form-control-static">{{ $member->created_at }}</p>
          </div>
        </div>
        <div class="hr-line-dashed"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-9 col-lg-offset-1">
        @if ($detail1)            
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
              <tr>
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
              </tr>
            @endforeach
            <tr>
              <td><strong>Submitted At</strong></td>
              <td>:</td>
              <td>{{ $detail1[0]['created_at'] }}</td>
            </tr>
          </table>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Profile Tahap 2</h5>
    <div class="ibox-tools">
      <a href="{{ url('member/completeprofile') }}/{{ $qg2->id }}">
        Edit
      </a>
      &nbsp;&nbsp;
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
              <tr>
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
              </tr>
            @endforeach              
          </table>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Profile Tahap 3</h5>
    <div class="ibox-tools">
      <a href="{{ url('member/completeprofile') }}/{{ $qg3->id }}">
        Edit
      </a>
      &nbsp;&nbsp;
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
              <tr>
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
              </tr>
            @endforeach              
          </table>
        @endif
      </div>
    </div>
  </div>    
</div>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Documents Uploaded</h5>
    <div class="ibox-tools">
      <a href="{{ url('member/completeprofile') }}/{{ $qgd->id }}">
        Edit
      </a>
      &nbsp;&nbsp;
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
              <tr>
                <td><strong>{{ $row->question }}</strong></td>
                <td>:</td>
                <td>{{ $row->answer }}</td>
              </tr>
            @endforeach              
          </table>
        @endif
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
</script>
@endpush