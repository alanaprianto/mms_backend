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
    <li>
      <a>Marketplace</a>
    </li>
    <li>
      <a>Edit</a>
    </li>
    <li class="active">
      <strong>{{ $product->title }}</strong>
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
    <strong>Edit Product</strong>
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
            <td><input type="text" class="form-control" name="title" value="{{$product->title}}"></td>
          </tr>
          <tr>
            <td><strong>Kategori Produk</strong></td>
            <td>:</td>
            <td>
              <div class="row">
                <div class="col-md-8">
                  <input name="category_id" value="{{$product->category_id}}" type="hidden">
                  <input type="text" class="form-control" name="category" value="{{$product->category->title}}" readonly>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-warning" onclick="changeCat()">Change</button>
                </div>
              </div>              
            </td>
          </tr>          
          <tr>
            <td><strong>Deskripsi Produk</strong></td>
            <td>:</td>
            <td><textarea class="form-control" name="description">{{$product->description}}</textarea></td>
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
              <label id="galeri-produk-error" class="error" type="hidden">Can only upload Maximum 6 Files!.</label>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td align="right"><input class="btn btn-primary" id="btnSubmit" type="submit" value="Update"></td>
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
  function changeCat() {
    var table = document.getElementById("theTable");

    var row = table.insertRow(2);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = "<strong>Kategori Produk 1</strong>";
    cell2.innerHTML = ":";
    cell3.innerHTML = 
      "<select id='id_category' class='form-control' name='category_id' onchange='setAnswerType(this.value, 1)'>"+
        "<option value='0'>-- Pilih Kategori Produk --</option>"+
        @foreach ($parent_cat as $key=>$cat)
          "<option value='{{ $cat->id }}'>{{ $cat->title }}</option>"+
        @endforeach
      "</select>";
  }

  function setAnswerType(id, index) {
    var stRow = index+2;
    var edRow = index+2;
    var ttRow = index+7;  

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
            // lebih
            table.deleteRow(stRow);
            table.deleteRow(edRow);            
          } else if (crRow=ttRow) {
            // sama
            table.deleteRow(stRow);            
          }

          var count = index+1;
          var row = table.insertRow(stRow);

          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          cell1.innerHTML = "<strong>Kategori Produk "+count+"</strong>";
          cell2.innerHTML = ":";
          cell3.innerHTML = 
            "<select id='id_category2' class='form-control' name='category_id' onchange='setAnswerType(this.value, "+count+")'>"+
              // "<option value='0'>-- Pilih Kategori Produk --</option>"+
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
      var thumbnail = [@foreach($gallery as $k => $value)
                        '{{ $value->id }}',
                      @endforeach];
      var names = [@foreach($gallery as $k => $value)
                        '{{ $value->filename }}',
                      @endforeach];
      var sizes = [@foreach($gallery as $k => $value)
                        '{{ $value->size }}',
                      @endforeach];
      var imgCount = 0;
      var ermsg = document.getElementById('galeri-produk-error');
      ermsg.style.display = "none";
      var id = "{{ $product->id }}";

      if (thumbnail) {
        imgCount = thumbnail.length;        
        for (var i = 0; i < thumbnail.length; i++) {
          var url = "{{url('images/product/thumbnail/')}}/"+thumbnail[i];
          var mockFile = { 
                    name: names[i],
                    size: sizes[i], 
                    type: 'image/jpeg',                    
                    url: url
                };

          // Call the default addedfile event handler
          myDropzone.emit("addedfile", mockFile);

          // And optionally show the thumbnail of the file:
          myDropzone.emit("thumbnail", mockFile, url);

          myDropzone.files.push(mockFile);
        }
      }

      document.querySelector("#btnSubmit").addEventListener("click", function(e) {
        console.log(imgCount);
        e.preventDefault();
        e.stopPropagation();        
                
        if ($("#cpForm").valid()) {          
          myDropzone.on('sending', function(file, xhr, formData){
            formData.append('product_id', id);
            formData.append('size', file.size);            
          });
          
          if (imgCount>6) {
            ermsg.style.display = "inline";
          } else {
            if (myDropzone.getQueuedFiles().length > 0) {
              myDropzone.processQueue();
            }
            else {
              // Upload anyway without files
              var cpForm = document.getElementById("cpForm");
              cpForm.action = "{{ $url }}/"+id;
              cpForm.submit();
            }
          }
        }
      });
      
      this.on("successmultiple", function(files, response) {        
        var cpForm = document.getElementById("cpForm");
        cpForm.action = "{{ $url }}/"+id;
        cpForm.submit();
      });

      this.on("removedfile", function(file) {
        imgCount = imgCount-1;
        $.post("{{ url('marketplace/delete_gallery') }}", {_token: "{{ csrf_token() }}", file: file.name, id_product: id}, function(result){
          console.log(result);
        });        
      });

      this.on("addedfile", function(file) { 
        imgCount = imgCount+1;
        if (imgCount>6) {
          this.removeFile(file);
        }
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
        from: "{{$product->price_min}}",
        to: "{{$product->price_max}}",
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