@extends('common.app')

@section('head')
<link href="{{ asset('css/plugins/dropzone/basic.css') }}" rel="stylesheet">
<link href="{{ asset('css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

<!-- SLIDER -->
<link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider-2.0.3.css') }}" rel="stylesheet">
<link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.skinHTML5.css') }}" rel="stylesheet">

<style type="text/css">
  .col-centered{
    float: none;
    margin: 0 auto;
  }
  .image-upload > input
  {
    display: none;
  }
</style>
@stop

@section('active-market')
  active
@stop

@section('content')
@php
  if (Auth::user()->role==1) {
    $url = url('admin/marketplace/');
  } else if (Auth::user()->role==2) {
    $url = url('member/marketplace/');
  } else if (Auth::user()->role==3) {
    $url = url('pusat/marketplace/');
  } else if (Auth::user()->role==4) {
    $url = url('provinsi/marketplace/');
  } else if (Auth::user()->role==5) {
    $url = url('daerah/marketplace/');
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
    <li>
      <a>Marketplace</a>
    </li>
    <li class="active">
      <strong>Create Product</strong>
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
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <strong>Create New Product</strong>
  </div>
  <div class="ibox-content">
    @include('errors.error_list')      
    
    <div class="row">
      <div class="col-lg-9 col-lg-offset-1">
        <form id="cpForm" method="POST" action="#" accept-charset="UTF-8">
          <input name="_method" value="PATCH" type="hidden">          
          <input name="created_by" value="{{ Auth::user()->id }}" type="hidden">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">      
        <table class="table" id="theTable">
          <tr>
            <td><strong>Judul Produk</strong></td>
            <td>:</td>
            <td><input type="text" class="form-control" name="title"></td>
          </tr>
          <tr>
            <td><strong>Kategori Produk 1</strong></td>
            <td>:</td>
            <td>
              <select id="id_category" class="form-control" name="category_id" onchange="setAnswerType(this.value, 1)">
                <option value='0' selected>-- Pilih Kategori Produk --</option>
                @foreach ($parent_cat as $key=>$cat)
                  <option value='{{ $cat->id }}'>{{ $cat->title }}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <td><strong>Deskripsi Produk</strong></td>
            <td>:</td>
            <td><textarea class="form-control" name="description"> </textarea></td>
          </tr>
          <tr>
            <td><strong>Range Harga</strong></td>
            <td>:</td>
            <td>
              <input id="ionrange_1" />
              <div class="row col-lg-12">
                <div class="form-group">
                  <label class="col-lg-4 control-label no-padding">Range Minimal</label>
                  <div class="col-lg-6">
                    <input type="text" name="price_min" id="range-min">
                  </div>                  
                </div>                
              </div>
              <div class="row col-lg-12">
                <div class="form-group">
                  <label class="col-lg-4 control-label no-padding">Range Maximal</label>
                  <div class="col-lg-6">
                    <input type="text" name="price_max" id="range-max">
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><strong>Galeri Produk</strong></td>
            <td>:</td>
            <td>
              <div id="galeri-produk" class="col-lg-12 dropzone" action="{{ url('marketplace/create_gallery') }}">
                <div class="dropzone-previews"></div>
              </div>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td align="right"><input class="btn btn-primary" id="btnSubmit" type="submit" value="Submit"></td>
          </tr>          
        </table>
        </form>
        <br><br>
      </div>
    </div>      
  </div>
</div>
<br/><br/>
@stop

@push('scripts')
<!-- DROPZONE -->
<script src="{{ asset('js/plugins/dropzone/dropzone.js') }}"></script>
<!-- IonRangeSlider -->
<script src="{{ asset('js/plugins/ionRangeSlider/ion.rangeSlider-2.1.6.js') }}"></script>
<!-- Jquery Validate -->
<script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
  function setAnswerType(id, index) {
    var stRow = index+1;
    var edRow = index+1;
    var ttRow = index+6;  

    if (id!=0) {
      $.ajax({
          url: "{{ url('api/marketplace/category/') }}" + "/" + id
      }).done(function(data) {
        if (data.length === 0) {

        } else {
          var options = "";
          for (i = 0; i < data.length; i++) {
            var answer = data[i]; 
            options += "<option value='"+answer.id+"'>"+answer.title+"</option>";
          }        

          var table = document.getElementById("theTable");
          var crRow = table.rows.length;
          console.log(crRow+" "+ttRow);

          if (crRow<ttRow) {
            
          } else if (crRow>ttRow) {
            table.deleteRow(stRow);
            table.deleteRow(edRow);
            
            console.log('lebih');
            console.log('deleting row '+stRow+' & '+edRow);
          } else if (crRow=ttRow) {
            table.deleteRow(stRow);          

            console.log('sama');
          }

          var count = index+1;
          var row = table.insertRow(stRow);

          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          cell1.innerHTML = "<strong>Kategori Produk "+count+"</strong>";
          cell2.innerHTML = ":";
          cell3.innerHTML = 
            "<select id='id_category_"+count+"' class='form-control required' name='category_id' onchange='setAnswerType(this.value, "+count+")'>"+
              options+
            "</select>";
        }
      });
    }
  }    
  

  Dropzone.options.galeriProduk = {
    
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 6,
    maxFiles: 6,
    addRemoveLinks: true,

    // The setting up of the dropzone
    init: function() {
      var myDropzone = this;
      var id = 0;

      // First change the button to actually tell Dropzone to process the queue.
      document.querySelector("#btnSubmit").addEventListener("click", function(e) {
        // Make sure that the form isn't actually being sent.
        e.preventDefault();
        e.stopPropagation();                  

        if ($("#cpForm").valid()) {
          $.post("{{ $url }}", {_token: "{{ csrf_token() }}"}, function(result){
            if (result.success) {
              id = result.id;
                
              myDropzone.on('sending', function(file, xhr, formData){
                formData.append('product_id', id);
                formData.append('size', file.size);
              });
            
              myDropzone.processQueue();
            }
          });
        }
      });            

      this.on("successmultiple", function(files, response) {        
        var cpForm = document.getElementById("cpForm");
        cpForm.action = "{{ $url }}/"+id;
        cpForm.submit();
      });

      this.on("error", function(file, message) { 
        alert(message);
        this.removeFile(file); 
      });
    }
  }
  
  $(document).ready(function(){      
    var $range = $("#ionrange_1"),
        $inputFrom = $("#range-min"),
        $inputTo = $("#range-max"),          
        instance,
        min = 100,
        max = 100000000;
    
    $range.ionRangeSlider({
        type: "double",
        prefix: "Rp",
        max_postfix: "+",
        min: min,
        max: max,          
        onStart: updateInputs,
        onChange: updateInputs,
        onFinish: updateInputs
    });

    function updateInputs (data) {
      document.getElementById("range-min").value = data.from;
      document.getElementById("range-max").value = data.to;          
    }

    instance = $range.data("ionRangeSlider");

    var slider = $range.data("ionRangeSlider");
    $inputFrom.on("change paste input", function (data) {
      value = document.getElementById('range-min').value;        
      slider.update({
        from: value
      });
    });

    $inputTo.on("change paste input", function (data) {
      value = document.getElementById('range-max').value;        
      slider.update({
        to: value
      });
    });

    // $.validator.addMethod("greaterThan", function(value, element) {
    //     $maxval = document.getElementById('range-max').value;
    //       if (value>) {
    //       } else {
    //       } 
    //       return response;
    //   },
    //   "Username is Already Taken"
    // );

    $.validator.addMethod("morethanzero", function(value, element) {
        return value > 0;
      },
        "This field is required"
    );

    $("#cpForm").validate({
      rules: {
        title: {
          required: true,            
        },
        description: {
          required: true,            
        },
        category_id: {            
          morethanzero: true,
        }
      }
    });
  });

  function goBack() {
      window.history.back();
  }
</script>
@endpush