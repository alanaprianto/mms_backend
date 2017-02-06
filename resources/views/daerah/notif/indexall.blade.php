@extends('daerah.app')

@section('sidebar')
  @include('daerah.sidebar-plain') 
@stop

@section('content')

<div class="col-lg-12">
  <div class="ibox float-e-margins">
    <h1>All Notifications</h1>
    <div class="ibox-content">
      <div>
        <div class="feed-activity-list">          
        @foreach ($notifs as $key=>$notif)
          <div class="feed-element">
            <a href="{{ url('daerah/notif') }}/{{ $notif->id }}" class="pull-left">
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