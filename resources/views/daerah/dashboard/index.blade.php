@extends('daerah.app')

@section('sidebar')
  @include('daerah.dashboard.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>
    <li class="active">
      <strong>Dashboard</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@push('scripts')

@endpush