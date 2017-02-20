<div class="form-group">
  {!! Form::label('img', 'Image', ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    @if ($slider)
      <img id="image" src="{{ $slider->slider_url }}" alt="your image" class="img-responsive" width="250px"/>      
    @else
      <img id="image" src="{{ asset('resources/assets/img/uimage.png') }}" alt="your image" class="img-responsive" width="250px"/>      
    @endif
    <label class="contact-avatar-btn">
      <span class="icon icon-camera"></span>
      <input class="file-upload-input" name="img" onchange="changeImg(this)" type="file">
    </label>
  </div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
  {!! Form::label('title', 'Title', ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">{!! Form::text('title', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
  {!! Form::label('link', 'Associated Link', ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">{!! Form::text('link', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
  <div class="col-sm-4 col-sm-offset-2">{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}</div>
</div>

<script type="text/javascript">
  function changeImg(input) {
      if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#image').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
      }
    }
</script>