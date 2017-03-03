@extends('frontpage.appregister')

@section('head')
<style type="text/css">
  .col-centered{
    float: none;
    margin: 0 auto;
  }
</style>
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
            @if ($code)
              <iframe src="{{ url('ktatrack') }}/{{$code}}" frameborder="0" scrolling="no" onload="resizeIframe(this)" width="100%">
              </iframe>
            @else
              <iframe src="{{ url('rntrack') }}/{{$norn}}" frameborder="0" scrolling="no" onload="resizeIframe(this)" width="100%">
              </iframe>
            @endif
            <br/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row features-block">
    <div class="col-lg-4 features-text wow fadeInLeft">
      <small>KADIN</small>
      <h2>Cek Keabsahan</h2>
      <p>Kartu Tanda Anggota (KTA) tidak sah jika tidak terdapat dalam hasil pencarian di bawah ini.</p>
      <form role="form" action="{{ url('rntrack') }}" method="post" class="registration-form">
        <div class="form-group">
          <label class="sr-only" for="rnnumber">Registrasi Nasional</label>
          <input type="text" name="rnnumber" placeholder="No Registrasi Nasional ..." class="form-first-name form-control" id="rnnumber" required minlength="13">
        </div>
        <div class="form-group">
          <select class="form-control m-b" name="type">
            <option value="ab">Anggota Biasa</option>
            <option value="alb">Anggota Luar Biasa</option>
          </select>
        </div>
        <button class="btn btn-success " type="submit">
          <i class="fa fa-search"></i>&nbsp;&nbsp;
          <span class="bold">Temukan</span>
        </button>
      </form>
    </div>
    <div class="col-lg-4 features-text wow fadeInLeft">
      <small>KADIN</small>
      <h2>Tracking</h2>
      <p>Untuk mengetahui status proses Kartu Tanda Anggota silahkan cek dibawah ini.</p>
      <form role="form" action="{{ url('ktatrack') }}" method="post" class="registration-form">
        <div class="form-group">
          <label class="sr-only" for="form-first-name">Kode Tracking</label>
          <input type="text" name="code" placeholder="Kode Tracking ..." class="form-first-name form-control" id="code" required minlength="8">
        </div>
        <button class="btn btn-success " type="submit">
          <i class="fa fa-search"></i>
          &nbsp;&nbsp;<span class="bold">Temukan</span>
        </button>
      </form>
    </div>
    <div class="col-lg-4 features-text wow fadeInLeft">
      <small>KADIN</small>
      <h2>Pendaftaran</h2>
      <p>Ingin bergabung ? silahkan klik dibawah ini untuk menjadi anggota kadin indonesia.</p>
      <a href="{{ url('register1')}}">
        <button class="btn btn-success " type="button">
          <i class="fa fa-user"></i>&nbsp;&nbsp;
          <span class="bold">Anggota Biasa</span>
        </button>
      </a>
      <a href="{{ url('register2')}}">
        <button class="btn btn-success " type="button">
          <i class="fa fa-users"></i>&nbsp;&nbsp;
          <span class="bold">Anggota Luar Biasa</span>
        </button>
      </a>
    </div>
  </div>
</div>
@stop

@push('scripts')
  <!-- Jquery Validate -->
  <script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>
  <script>
      function resizeIframe(obj) {
          obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
      }
  </script>
@endpush