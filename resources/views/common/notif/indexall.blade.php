@extends('common.app')

@section('content')
  <div class="col-lg-10">
    <h1>
      <i class="fa fa-bell"></i>
      &nbsp;
      All Notifications
    </h1>
  </div>
@stop

@section('iframe')
@php
  if (Auth::user()->role==1) {
    $nurl = url('admin/notif/');
  } else if (Auth::user()->role==2) {
    $nurl = url('member/notif/');
  } else if (Auth::user()->role==3) {
    $nurl = url('pusat/notif/');
  } else if (Auth::user()->role==4) {
    $nurl = url('provinsi/notif/');
  } else if (Auth::user()->role==5) {
    $nurl = url('daerah/notif/');
  } else if (Auth::user()->role==6) {
    $nurl = url('alb/notif/');
  }
@endphp
<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <div class="ibox-content">
      <div>
        <div class="feed-activity-list">
          @foreach ($notifs as $key=>$notif)
            <div class="feed-element">
              <a href="{{ $nurl }}/{{ $notif->id }}" class="pull-left">
                <img alt="image" class="img-circle" src="{{ url('/images') }}/{{ $notif->sender_uname }}">
              </a>
              <div class="media-body ">
                <small class="pull-right">{{ $notif->crt_human }}</small>
                {{ $notif->value }}<br>
                <small class="text-muted">{{ $notif->created_at }}</small>
              </div>
            </div>
          @endforeach
        </div>
        <!-- <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button> -->
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
@endpush