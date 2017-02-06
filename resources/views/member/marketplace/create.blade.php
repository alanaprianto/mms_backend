@extends('member.app')

@section('head')
<link href="{{ asset('resources/assets/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
<link href="{{ asset('resources/assets/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">

<!-- SLIDER -->
<link href="{{ asset('resources/assets/css/plugins/ionRangeSlider/ion.rangeSlider-2.0.3.css') }}" rel="stylesheet">
<link href="{{ asset('resources/assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinHTML5.css') }}" rel="stylesheet">

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
      <div class="col-lg-12 col-centered">

        <form id="cpForm" method="POST" action="{{ url('member/marketplace') }}" accept-charset="UTF-8">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">

          <div class="form-group col-md-12 no-padding">
            <label class="col-lg-2 control-label no-padding">Judul Produk</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="title">
            </div>
          </div>

          <div class="form-group col-md-12 no-padding">
            <label class="col-lg-2 control-label no-padding">Kategori Produk 1</label>
            <div class="col-lg-6">                
              <select id="id_category" class="form-control" name="category_id" onchange="setAnswerType()">
                <option value='0'>-- Pilih Kategori Produk --</option>
                @foreach ($parent_cat as $key=>$cat)
                  <option value='{{ $cat->id }}'>{{ $cat->title }}</option>
                @endforeach                  
              </select>
            </div>
          </div>
            
          <div class="form-group col-md-12 no-padding" id="answer_form">

          </div>

          <div class="form-group col-md-12 no-padding">
            <label class="col-lg-2 control-label no-padding">Deskripsi Produk</label>
            <div class="col-lg-6">
              <textarea class="form-control" name="description"> </textarea>
            </div>
          </div>

          <div class="form-group col-md-12 no-padding">
            <label class="col-lg-2 control-label no-padding">Range Harga</label>
            <div class="col-lg-6">              
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
            </div>
          </div>

          <div class="form-group col-md-12 no-padding">
            <label class="col-lg-2 control-label no-padding">Galeri Produk</label>
            <div id="galeri-produk" class="col-lg-6 dropzone" action="{{ url('member/marketplace/create_gallery') }}">
              <div class="dropzone-previews"></div>
            </div>
          </div>          

          <input class="btn btn-primary" id="btnSubmit" type="submit" value="Submit">
        </form>
          
      </div>
    </div>      
  </div>
</div>

@stop

@push('scripts')
<!-- DROPZONE -->
<script src="{{ asset('resources/assets/js/plugins/dropzone/dropzone.js') }}"></script>
<!-- IonRangeSlider -->
<script src="{{ asset('resources/assets/js/plugins/ionRangeSlider/ion.rangeSlider-2.1.6.js') }}"></script>

<script type="text/javascript">
  function setAnswerType() {
    var id = document.getElementById("id_category").value;

    $.ajax({
          url: "{{ url('member/marketplace/category/') }}" + "/" + id
      }).done(function(data) {        
        var element = document.getElementById("answer_form");
        var par = document.getElementById("answer_par");

        if (par) {
          par.remove();
        }

        var options = "";
        for (i = 0; i < data.length; i++) {
          var answer = data[i];
          options += "<option value='"+answer.id+"'>"+answer.title+"</option>";
        }

        $("<div id='answer_par'>"+                    
            "<label class='col-sm-2 control-label'>Kategori Produk 2</label>"+
            "<div class='col-lg-6'>"+
              "<select id='id_category2' class='form-control' name='category_id' onchange='setAnswerType()'>"+
                "<option value='0'>-- Pilih Kategori Produk --</option>"+
                options+
              "</select>"+
            "</div>"+            
          "</div>").appendTo(element);

      });
    }

    Dropzone.options.galeriProduk = { // The camelized version of the ID of the form element

      // The configuration we've talked about above
      autoProcessQueue: false,
      uploadMultiple: true,
      parallelUploads: 6,
      maxFiles: 6,

      // The setting up of the dropzone
      init: function() {
        var myDropzone = this;
        console.log("dropzone initialized");

        // First change the button to actually tell Dropzone to process the queue.
        document.querySelector("#btnSubmit").addEventListener("click", function(e) {
          // Make sure that the form isn't actually being sent.
          e.preventDefault();
          e.stopPropagation();
          myDropzone.processQueue();
        });
        // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
        // of the sending event because uploadMultiple is set to true.
        this.on("sendingmultiple", function() {
          // Gets triggered when the form is actually being sent.
          // Hide the success button or the complete form.
        });
        this.on("successmultiple", function(files, response) {
          // Gets triggered when the files have successfully been sent.
          // Redirect user or notify of success.          
          document.getElementById("cpForm").submit();
        });
        this.on("errormultiple", function(files, response) {
          // Gets triggered when there was an error sending the files.
          // Maybe show form again, and notify user of error
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
    });
</script>
@endpush