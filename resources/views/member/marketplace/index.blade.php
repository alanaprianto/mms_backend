@extends('member.app')

@section('active-market')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Marketplace</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li class="active">
      <strong>Marketplace</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
    <div class="title-action">
      <a href='marketplace/create' class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah Produk</a>
    </div>
  </div>
@stop

@section('iframe')
<div class="col-lg-12 white-bg">
  <div class="panel blank-panel">
    <div class="panel-heading">      
      <div class="panel-options">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#tab-1">Barang</a></li>
          <li class=""><a data-toggle="tab" href="#tab-2">Jasa</a></li>
        </ul>
      </div>
    </div>
    <div class="panel-body">
      <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
          <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>
          <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.</p>
          <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now. When.</p>
        </div>
        <div id="tab-2" class="tab-pane">
          <strong>Donec quam felis</strong>
          <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>
          <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@stop