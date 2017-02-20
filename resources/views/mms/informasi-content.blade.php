@extends('mms.appregister')

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
            <form role="form" action="" method="post" class="registration-form">
                <div class="form-group">
                    <label class="sr-only" for="form-first-name">Registrasi Nasional</label>
                    <input type="text" name="form-first-name" placeholder="No Registrasi Nasional ..." class="form-first-name form-control" id="form-first-name">
                </div>
                <div class="form-group">
                    <select class="form-control m-b" name="account">
                        <option>Anggota Biasa</option>
                        <option>Anggota Luar Biasa</option>
                    </select>
                </div>
                <button class="btn btn-success " type="button"><i class="fa fa-search"></i>&nbsp;&nbsp;<span class="bold">Temukan</span></button>
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

@section('scripts')
<!-- Jquery Validate -->
<script src="{{ asset('resources/assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
@stop