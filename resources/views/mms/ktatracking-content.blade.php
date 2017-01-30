@extends('mms.appregister')

@section('head')
<style type="text/css">
  .col-centered{
    float: none;
    margin: 0 auto;
  }
</style>
<script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
@stop

@section('infoactive')
  <?php echo 'active';?>
@stop

@section('content')
<div class="container">
  <div class="row features-block">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">            
          </div>
          <div class="ibox-content">
            <div class="col-lg-8 col-centered">
              <iframe src="{{ url('ktatrack') }}/{{$code}}" frameborder="0" scrolling="no" onload="resizeIframe(this)" width="100%"></iframe>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@stop

@section('scripts')

@stop