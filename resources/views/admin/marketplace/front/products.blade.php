@extends('common.app')

@section('active-market')
  active
@stop
@section('active-market-frontend')
  active
@stop

@section('head')
    <style>
        .col-centered{
            float: none;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-10">
        <h2>Frontend</h2>
        <ol class="breadcrumb">
            <li>
                <a>Admin</a>
            </li>
            <li>
                <a>Marketplace</a>
            </li>
            <li>
                <a>Frontend</a>
            </li>
            <li class="active">
                <strong>Product Detail</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <div class="title-action">
            <a href='/' class="btn btn-primary" onclick="goBack()">
                <span class="fa fa-arrow-left fa-fw"></span>
                &nbsp;&nbsp;Back
            </a>
        </div>
    </div>
@stop

@section('iframe')
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>List Product for "{{ $mf->name }}"</h5>
          <div class="ibox-tools"><!-- any link icon --></div>
        </div>
        <div class="ibox-content">
            <table style="width: 100%;max-width: 100%;background-color:transparent;">
                <tr>
                    <td width="40%" valign="top">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="table1">
                            <thead>
                            <tr>
                                <th>Available Product</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </td>
                    <td width="20%">
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-default " type="button">Add All&nbsp;&nbsp;>></button><br/>
                            <button class="btn btn-default " type="button">Add&nbsp;&nbsp;>></button>
                            <br/><br/>
                            <label class="control-label">Select Category</label><br/>
                            <select class="form-control m-b" name="account">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select><br/>
                            <button class="btn btn-default " type="button"><<&nbsp;&nbsp;Remove</button>
                            <button class="btn btn-default " type="button"><<&nbsp;&nbsp;Remove All</button>
                        </div>
                    </td>
                    <td width="40%" valign="top">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline" id="table2">
                            <thead>
                            <tr>
                                <th>Product of "{{ $mf->name }}"</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script>
  function goBack() {
    window.history.back();
  }

  $(function() {
      $('#table1').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('admin/ajax/marketplace/product/all')}}",
          columns: [
              { "data" : "title" },
          ],
          "columnDefs": [
              {
                  "render": function ( data, type, row ) {
                      if (row.gallery_id!=0) {
                          return    "<div class='feed-element'>"+
                                        "<a href='#' class='pull-left'>"+
                                            "<img alt='image' class='img-circle' src='"+row.picture_url+"'>"+
                                        "</a>"+
                                        "<div class='media-body '>"+
                                            "<small class='pull-right'>"+row.crt_human+"</small>"+
                                            row.title+" <br>"+
                                            "<small class='text-muted'>"+row.created_at+"</small>"+
                                        "</div>"+
                                    "</div>";
                      } else {
                          return "<label align='center'>-</label>";
                      }
                  },
                  "targets": 0
              },
          ]
      });
  });
</script>
@endpush