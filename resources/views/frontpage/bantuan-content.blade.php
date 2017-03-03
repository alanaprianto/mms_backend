@extends('frontpage.appregister')

@section('helpactive')
  <?php echo 'active';?>
@stop

@section('content')
<div class="container">
    <div class="row features-block">
        <div class="middle-box text-center loginscreen   animated fadeInDown">
            <div>
                <div>
                    <img class="logo-name" src="{{ asset('img/alur_proses.png') }}"/>
                </div>
                <br/>
                <div>
                    <img class="logo-name" src="{{ asset('img/proses_kerja.png') }}"/>
                </div>
                <br/>
                <h4>
                    Informasi lebih lanjut dapat menghubungi : Bagian Keanggotaan Sekretariat KADIN Indonesia
                </h4>
                <h5 align="center">
                    Menara Kadin Indonesia Lantai 29.<br/>
                    Jl. H.R. Rasuna Said X-5 Kav. 2-3 Jakarta 12950 Indonesia<br/>
                    Telepon: (62-21) 5274484 Ext. 126<br/>
                    Fax: (62-21) 5274331, 5274332
                </h5>
            </div>
        </div>
    </div>
</div>
@stop
