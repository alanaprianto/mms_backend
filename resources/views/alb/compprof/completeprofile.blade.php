@extends('common.app')

@section('active-comprof')
  active
@stop

@section('content')
<div id="breadcrumbs-bar" class="col-lg-10">
  <h2>Form Pelengkapan Profile</h2>
  <ol class="breadcrumb">
    <li>
      <a>Extraordinary Member</a>
    </li>    
    <li class="active">
      <strong>Company Profile</strong>
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
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <strong>Update Profile Information</strong><br/>
      <small>Silahkan melengkapi form dibawah ini !</small>
    </div>
    <div class="ibox-content">      
      @include('errors.error_list')

      <form method="POST" action="{{ url('registerii') }}/{{ $fqg->id}}" accept-charset="UTF-8" id="wadah" enctype="multipart/form-data">
        <input name="_token" value="{{ csrf_token() }}" type="hidden">                                
      </form>                   
    </div>
  </div>
</div>
@stop

@push('scripts')
    @include('scripts.setkbli_script')
	<script type="text/javascript">
	    var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
        var answers = JSON.parse("{{ $fresults }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));

        function goBack() {
            window.history.back();
        }
	</script>
    @include('scripts.dynamic_form_script1')
@endpush