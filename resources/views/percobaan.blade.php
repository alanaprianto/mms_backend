<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Bootstrap File Input Demo - © Kartik</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Kraaje Fileinputmin CSS -->
    <link href="{{ asset('resources/assets/css/fileinput.min.css') }}" rel="stylesheet">
  </head>
  <body>  
    <div class="container">      
      <div class="row">        
        <div class="col-md-2 col-md-offset-5">
          <img id="blah" src="#" alt="your image" class="img-responsive center-block" />
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
          </div>
          <img src="{{ url('images')}}/{{ Session::get('path') }}">
          @endif

          <form action="{{ url('image-upload') }}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}                        
            <div class="input-group-btn">
              <div class="btn btn-primary btn-file">
                <i class="glyphicon glyphicon-folder-open"></i>&nbsp;
                <span class="hidden-xs">Browse …</span>
                <input name="image" type="file" id="imgInp">
              </div>
              &nbsp;
              <button type="submit" class="btn btn-success">Upload</button>
            </div>             
          </form>
        </div>
      </div>
    </div>        

    <!-- JQuery -->
    <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>    
    <script type="text/javascript">
      function readURL(input) {

          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#imgInp").change(function(){
          readURL(this);
      });


    </script>
  </body>
</html>