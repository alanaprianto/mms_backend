@extends('frontpage.appregister')

@section('infoactive')
  <?php echo 'active';?>
@stop

@section('content')
<div class="container">
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
          <label class="sr-only" for="code">Kode Tracking</label>
          <input type="text" name="code" placeholder="Kode Tracking ..." class="form-first-name form-control" id="code" required minlength="20">
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
      <a href="{{ url('register/ab')}}">
        <button class="btn btn-success " type="button">
          <i class="fa fa-user"></i>&nbsp;&nbsp;
          <span class="bold">Anggota Biasa</span>
        </button>
      </a>
      <a href="{{ url('register/alb')}}">
        <button class="btn btn-success " type="button">
          <i class="fa fa-users"></i>&nbsp;&nbsp;
          <span class="bold">Anggota Luar Biasa</span>
        </button>
      </a>
    </div>
  </div>
</div>
@stop

@section('scripts')
<!-- Jquery Validate -->
<script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>
@stop