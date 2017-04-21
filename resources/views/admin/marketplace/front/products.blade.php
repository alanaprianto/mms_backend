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
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
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
                            <table class="table" id="theTable">
                                <tr>
                                    <td>
                                        <button id="add" class="btn btn-default " type="button">Add&nbsp;&nbsp;>></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label">Select Category</label><br/>
                                        <select id="cat_id" class="form-control" name="cat_id" onchange="setAnswerType(this.value, 1)">
                                            <option value='0' selected>-- Pilih Kategori Produk --</option>
                                            @foreach ($parent_cat as $key=>$cat)
                                                <option value='{{ $cat->id }}'>{{ $cat->title }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button id="remove" class="btn btn-default " type="button"><<&nbsp;&nbsp;Remove</button>
                                    </td>
                                </tr>
                            </table>
                            <br/><br/>

                            <br/>

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

  var type = "{{ $mf->type }}";
  if (type.indexOf("category") !== -1) {
      document.getElementById("add").disabled = true;
      document.getElementById("remove").disabled = true;
  }

  $(document).ready(function() {
      var table1 = $('#table1').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              "type": 'POST',
              "url": "{{ url('admin/ajax/marketplace/frontend/product/all')}}/{{ $mf->id }}",
              "data": function(d){
                  d.category = getCat();
              }
          },
          columns: [
              { "data" : "title" }
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

      var table2 = $('#table2').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('admin/ajax/marketplace/frontend/product/')}}/{{ $mf->id }}",
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

      $('#table1').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
      });

      $('#table2').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
      });

      $('#add').on('click', function (event) {
          var datas = table1.rows('.selected').data();
          var products = '';
          for (i=datas.length;i>0;i--) {
              products += datas[i-1].id+',';
          }

          var url = "{{ url('admin/ajax/marketplace/frontend/product/add') }}";
          $.ajax({
              url: url,
              type: "POST",
              data: {
                  _token: "{{ csrf_token() }}",
                  products: products,
                  id_mfront: "{{ $mf->id }}",
                  type: type
              }
          }).done(function(data) {
              if (data.success) {
                  toastr.success(data.msg);
              } else {
                  toastr.error(data.msg);
              }

              var ref1 = $('#table1').DataTable();
              var ref2 = $('#table2').DataTable();
              ref1.ajax.reload(null, false);
              ref2.ajax.reload(null, false);
          });
      });

      $('#remove').on('click', function (event) {
          var datas = table2.rows('.selected').data();
          var products = '';
          for (i=datas.length;i>0;i--) {
              products += datas[i-1].id+',';
          }

          var url = "{{ url('admin/ajax/marketplace/frontend/product/remove') }}";
          $.ajax({
              url: url,
              type: "POST",
              data: {
                  _token: "{{ csrf_token() }}",
                  products: products,
                  id_mfront: "{{ $mf->id }}",
                  type: type
              }
          }).done(function(data) {
              if (data.success) {
                  toastr.success(data.msg);
              } else {
                  toastr.error(data.msg);
              }

              var ref1 = $('#table1').DataTable();
              var ref2 = $('#table2').DataTable();
              ref1.ajax.reload(null, false);
              ref2.ajax.reload(null, false);
          });
      });
  });

  function setAnswerType(id, index) {
      var stRow = index+1;
      var edRow = index+1;
      var ttRow = index+3;

      console.log(stRow+' '+edRow+' '+ttRow);
      if (id!=0) {
          var table = document.getElementById("theTable");
          var crRow = table.rows.length;

          $.ajax({
              url: "{{ url('api/marketplace/category/') }}" + "/" + id
          }).done(function(data) {
              if (data.length === 0) {
                  if (crRow<ttRow) {

                  } else if (crRow>ttRow) {
                      table.deleteRow(stRow);
                      table.deleteRow(edRow);

                      console.log('lebih');
                      console.log('deleting row '+stRow+' & '+edRow);
                  } else if (crRow==ttRow) {
                      table.deleteRow(stRow);

                      console.log('sama');
                  }
              } else {
                  var options = "";
                  for (i = 0; i < data.length; i++) {
                      var answer = data[i];
                      options += "<option value='"+answer.id+"'>"+answer.title+"</option>";
                  }

                  if (crRow<ttRow) {

                  } else if (crRow>ttRow) {
                      table.deleteRow(stRow);
                      table.deleteRow(edRow);

                      console.log('lebih');
                      console.log('deleting row '+stRow+' & '+edRow);
                  } else if (crRow==ttRow) {
                      table.deleteRow(stRow);

                      console.log('sama');
                  }

                  var count = index+1;
                  var row = table.insertRow(stRow);

                  var cell1= row.insertCell(0);
                  cell1.innerHTML =
                      "<strong>Select Category "+count+"</strong>"+
                      "<select id='cat_id' class='form-control required' name='cat_id' onchange='setAnswerType(this.value, "+count+")'>"+
                      options+
                      "</select>";
              }

              refreshTable1(id);
          });
      }
  }

  function refreshTable1(id) {
      setCat(id);

      var ref1 = $('#table1').DataTable();
      ref1.ajax.reload(null, false);
  }

  var category = 0;
  function getCat() {
      return category;
  }

  function setCat(cat) {
      category = cat;
  }
</script>
@endpush