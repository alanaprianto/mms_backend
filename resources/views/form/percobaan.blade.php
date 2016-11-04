<html>
<head>
  <title>Percobaan</title>
  <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Kraaje Fileinputmin CSS -->
  <link href="{{ asset('resources/assets/css/fileinput.min.css') }}" rel="stylesheet">
</head>
<body>

	<div class="well">
		<h1>Form Percobaan</h1>
		<br>

		@include('errors.error_list')
		
		{!! Form::open(['action' => ['PercobaanController@percobaanstore'], 'id' => 'wadah', 'enctype' => 'multipart/form-data' ]) !!}	
			
		{!! Form::close() !!}     
		  
	</div>

	<!-- JQuery -->
    <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
    @include('dynamic_form_script')
    <script type="text/javascript">
    	function asdad(input, id) {
			console.log(id);

			var element = document.getElementById("text-asdad");
	        
			element.innerHTML = 
				"<i class='glyphicon glyphicon-file kv-caption-icon'></i>"+
			   	input.files[0].name;

			// if (input.files && input.files[0]) {
	  //       	var reader = new FileReader();

	  //           reader.onload = function (e) {
	  //           	$('#blah').attr('src', e.target.result);
	  //           }

	  //          	reader.readAsDataURL(input.files[0]);
	  //       }
		}
    </script>
</body>
</html>