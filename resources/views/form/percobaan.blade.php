<html>
<head>
  <title>Percobaan</title>
  <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Kraaje Fileinputmin CSS -->
  <link href="{{ asset('resources/assets/css/fileinput.min.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('resources/assets/css/register/style.css') }}" rel="stylesheet"> -->
</head>
<body>

	<div class="well">
		<h1>Form Percobaan</h1>
		<br>

		@include('errors.error_list')
		
		{!! Form::open(['action' => ['PercobaanController@percobaanstore'], 'id' => 'wadah', 'enctype' => 'multipart/form-data' ]) !!}	
			
		{!! Form::close() !!}     
		<!-- <button onclick="getNews()">
			Get News
		</button>

		<div class='input-group-btn'>
			<div class='btn btn-asdad btn-file'>
				<i class='glyphicon glyphicon-folder-open'></i>
				&nbsp;&nbsp;
				<span class='hidden-xs'>Browse …</span>
			<input name='id_question_fileupload_"+id+"' type='file' class='file' onchange='setImgText(this, "+id+")'>
			</div>
		</div> -->
	</div>

	<!-- JQuery -->
    <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
    {{ $alb = false }}
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

		function getNews() {
		  	$.ajax({    
	          url: "http://110.74.178.215/portal/kadin-indonesia/list/view_detail/list",
	          type: "post",
	          data: {	            
	            id: "berita_kadin",
				param: "news",
				sort: "desc",
				order: "year",
				limit: 20,
				offset: 0
	          }
	        }).done(function(data) {
	          console.log(data);	          
	        });
		}
    </script>
</body>
</html>