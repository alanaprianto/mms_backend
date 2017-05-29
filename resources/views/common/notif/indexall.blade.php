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
    $url = url('admin/ajax/notifall/');
  } else if (Auth::user()->role==2) {
    $nurl = url('member/notif/');
    $url = url('member/ajax/notifall/');
  } else if (Auth::user()->role==3) {
    $nurl = url('pusat/notif/');
    $url = url('pusat/ajax/notifall/');
  } else if (Auth::user()->role==4) {
    $nurl = url('provinsi/notif/');
    $url = url('provinsi/ajax/notifall/');
  } else if (Auth::user()->role==5) {
    $nurl = url('daerah/notif/');
    $url = url('daerah/ajax/notifall/');
  } else if (Auth::user()->role==6) {
    $nurl = url('alb/notif/');
    $url = url('alb/ajax/notifall/');
  }
@endphp
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">        
        <div class="ibox-content">
          <table class="table table-striped table-bordered table-hover dataTables-example" id="notif-table">
            <thead>
              <tr>
                <th style="width:5%;">Image</th>
                <th>Notification</th>
                <th>Received</th>
                <th style="width:10%;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

          <!-- <div class="feed-activity-list">
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
        </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
  $(function() {
    var url = "{{ $url }}";
    var nurl = "{{ $nurl }}";
    var img = "{{ url('/images') }}";
    $('#notif-table').DataTable({
      processing: true,
      serverSide: true,
      iDisplayLength: 50,
      ajax: url,
      columns: [
        { "data" : "sender_uname" },
        { "data" : "value" },        
        { "data" : "crt_human" },
        { "data" : "id"}
      ],
      "columnDefs": [
        {
          "render": function ( data, type, row ) {
            return '<img alt="image" class="img img-responsive" src="'+img+'/'+row.sender_uname+'">';
          },
          "targets": 0
        },
        {
          "render": function ( data, type, row ) {
            return  '<div class="media-body ">'+
                      row.value+'<br>'+
                      '<small class="text-muted">'+row.created_at+'</small>'+
                    '</div>';
          },
          "targets": 1
        },
        {
          "render": function ( data, type, row ) {
            return '<a href="'+nurl+'/'+row.id+'" class="btn btn-warning btn-xs">'+
                      '<span class="glyphicon glyphicon-search"></span>'+
                      '&nbsp;&nbsp;View Notification'+
                    '</a>';
          },
          "targets": 3
        }        
      ]
    });
  });
</script>
@endpush