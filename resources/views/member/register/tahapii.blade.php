@extends('common.app')

@section('content')
<div id="breadcrumbs-bar" class="col-lg-10">
  <h2>Anggota Biasa</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li>
      <a>Profile</a>
    </li>
    <li class="active">
      <strong>Profile Completion</strong>
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
        <strong>Update Profile Information</strong><br/>
        <small>Silahkan melengkapi form dibawah ini !</small>
      </div>
      <div class="ibox-content">
        @include('errors.error_list')

        {!! Form::open(['url' => ['registerii', 0], 'id' => 'wadah']) !!}
                                
		{!! Form::close() !!}
      </div>
    </div>
  </div>
@stop

@push('scripts')
    @include('scripts.setkbli_script')
	<script type="text/javascript">
		function resizeIframe(obj) {
	      console.log(obj.contentWindow.document.body.scrollHeight);
	      obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	    }

        var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
        var answers = JSON.parse("{{ $fresults }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
	</script>
    @include('scripts.dynamic_form_script1')
@endpush