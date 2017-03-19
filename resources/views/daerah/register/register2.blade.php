@extends('common.app')

@section('active-register')
  active
@stop
@section('active-register-alb')
	active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Pendaftaran Anggota Luar Biasa</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>        
    <li class="active">
      <strong>Pendaftaran</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
	<iframe src="{{ url('register/alb/frame') }}" frameborder='0' width='100%' onload='resizeIframe(this)'>
	</iframe>
@stop

@push('scripts')
	<script type="text/javascript">
		function resizeIframe(obj) {
	      console.log(obj.contentWindow.document.body.scrollHeight);
	      obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	    }
	</script>
@endpush