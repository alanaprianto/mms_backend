@extends('common.app')

@section('active-market')
  active
@stop

@section('content')
@php
  if (Auth::user()->role==2) {
    $url = url('member/marketplace/');
  } else if (Auth::user()->role==6) {
    $url = url('alb/marketplace/');
  }
@endphp

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
<div class="row">

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
            <table class="table table-striped table-bordered table-hover dataTables-example" id="barang-table">
              <thead>
                <tr>
                  <th class="text-center">Photo</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Category</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Options</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="feed-activity-list" id="wadah-barang">
              
            </div>
            <ul id="wadah-barang-pg" class="pagination c-theme"></ul>
          </div>
          <div id="tab-2" class="tab-pane">
            <table class="table table-striped table-bordered table-hover dataTables-example" id="jasa-table" width="100%">
              <thead>
                <tr>
                  <th class="text-center">Photo</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Category</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Options</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="feed-activity-list" id="wadah-jasa">
              
            </div>
            <ul id="wadah-jasa-pg" class="pagination c-theme"></ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal inmodal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <i class="fa fa-warning modal-icon"></i>
          <h4 class="modal-title">Warning!</h4>
      </div>
      <div class="modal-body">
        <p>This record will be deleted permanently.</p>
        <p>Are you sure to delete record <span class="recordname"></span></p>
      </div>
      <div class="modal-footer">
        <input type="hidden" class="form-control" id="id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="submit_delete" type="submit" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
    $('#deleteModal').on('show.bs.modal', function (event) {  
      var button = $(event.relatedTarget) // Button that triggered the modal      
      id = button.data('id');
      name = button.data('name');
      
      var modal = $(this);
      modal.find('.recordname').text('"' + name + '"?').css('font-weight', 'bold');
      modal.find('.modal-footer .form-control').val(id);
    });

    $('#submit_delete').on('click', function (event) {
      $.ajax({
        url: "{{ $url }}/"+id,
        type: "post",
        data: {
          _method: 'DELETE', 
          _token: "{{ csrf_token() }}",
        }
      }).done(function(data) {
        console.log(data);

        $('#deleteModal').modal('hide'); 

        if (data.success) {
          toastr.success(data.msg);
        } else {
          toastr.error(data.msg);
        }

        setTimeout(location.reload.bind(location), 1000);
      });
    });

    $(function() {
    $('#barang-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('marketplace/ajax/listBarang')}}",
      columns: [
        { "data" : "picture_url" },
        { "data" : "title" },
        { "data" : "category_title" },
        { "data" : "id"},
        { "data" : "id"}
      ],
      "columnDefs": [
        {          
          "render": function ( data, type, row ) {
            if (row.gallery_id!=0) {
              return "<img src='"+row.picture_url+"' class='img img-responsive' style='width:100%;'>";
            } else {
              return "<label align='center'>-</label>";
            }          
          },
          "targets": 0
        },
        {          
          "render": function ( data, type, row ) {
            return "<div class='col-md-12'>"+
                    "<small class='pull-right'>"+row.crt_human+"</small>"+
                    "<strong>"+row.title+"</strong><br>"+
                    "<small class='text-muted'>"+row.created_at+"</small>"+
                  "</div>";
          },
          "targets": 1
        },
        {          
          "render": function ( data, type, row ) {
            return "<div class='text-center'>"+
                    row.category_title+
                  "</div>";
          },
          "targets": 2
        },
        {          
          "render": function ( data, type, row ) {
            return "<div class='text-center'>"+
                    row.price_min+" - "+row.price_max+
                  "</div>";
          },
          "targets": 3
        },
        {          
          "render": function ( data, type, row ) {
          return "<div class='pull-right'>"+
                  "<a href='marketplace/"+row.id+"' class='btn btn-xs btn-success'><i class='fa fa-eye'></i> View </a>&nbsp;"+
                  "<a href='marketplace/"+row.id+"/edit' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i> Edit </a>&nbsp;"+
                  "<a class='btn btn-xs btn-danger' data-toggle='modal' data-target='#deleteModal' data-id='"+row.id+"' data-name='"+row.title+"' title='Delete Item'><i class='fa fa-trash'></i> Delete </a>&nbsp;"+
                "</div>";
          },
          "targets": 4
        },        
      ]
    });
  });

  $(function() {
    $('#jasa-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('marketplace/ajax/listJasa')}}",
      columns: [
        { "data" : "picture_url" },
        { "data" : "title" },
        { "data" : "category_title" },
        { "data" : "id"},
        { "data" : "id"}
      ],
      "columnDefs": [
        {          
          "render": function ( data, type, row ) {
            if (row.gallery_id!=0) {
              return "<img src='"+row.picture_url+"' class='img img-responsive' style='width:100%;'>";
            } else {
              return "<label align='center'>-</label>";
            }          
          },
          "targets": 0
        },
        {          
          "render": function ( data, type, row ) {
            return "<div class='col-md-12'>"+
                    "<small class='pull-right'>"+row.crt_human+"</small>"+
                    "<strong>"+row.title+"</strong><br>"+
                    "<small class='text-muted'>"+row.created_at+"</small>"+
                  "</div>";
          },
          "targets": 1
        },
        {          
          "render": function ( data, type, row ) {
            return "<div class='text-center'>"+
                    row.category_title+
                  "</div>";
          },
          "targets": 2
        },
        {          
          "render": function ( data, type, row ) {
            return "<div class='text-center'>"+
                    row.price_min+" - "+row.price_max+
                  "</div>";
          },
          "targets": 3
        },
        {          
          "render": function ( data, type, row ) {
          return "<div class='pull-right'>"+
                  "<a href='marketplace/"+row.id+"' class='btn btn-xs btn-success'><i class='fa fa-eye'></i> View </a>&nbsp;"+
                  "<a href='marketplace/"+row.id+"/edit' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i> Edit </a>&nbsp;"+
                  "<a class='btn btn-xs btn-danger' data-toggle='modal' data-target='#deleteModal' data-id='"+row.id+"' data-name='"+row.title+"' title='Delete Item'><i class='fa fa-trash'></i> Delete </a>&nbsp;"+
                "</div>";
          },
          "targets": 4
        },        
      ]
    });
  });
</script>
@endpush