<html>
<head>
  <title>Percobaan</title>
</head>
<body>

	<div class="well">
		<h1>Form Percobaan</h1>
		<br>

		@include('errors.error_list')
		
		{!! Form::open(['action' => ['PendaftaranController@percobaanstore'], 'id' => 'percobaan']) !!}	
			
		{!! Form::close() !!}		
	</div>

	<!-- JQuery -->
    <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
	<script type="text/javascript">
		var element = document.getElementById("percobaan");
		$(window).on('load', function(e) {		
			var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
						
			console.log(data);
		    for (i=0; i<data.length; i++) {
		    	var json = data[i];

		    	var type = json.question_type.name;

		    	var equal1 = type.toUpperCase() === "USERNAME";
		    	var equal2 = type.toUpperCase() === "CONFIRM PASSWORD";
		    	var equal3 = type.toUpperCase() === "PASSWORD";
		    	var equal4 = type.toUpperCase() === "DIVIDER TITLE";
		    	var equal5 = type.toUpperCase() === "DIVIDER";
		    	var equal6 = type.toUpperCase() === "QUESTION";

		    	var html = "";
		    	var qid = "";

		    	if (equal1) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "username";		    

		    		setFormQuestion(json, html, qid)		
		    	} else if (equal2) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "password_confirmation";		 

		    		setFormQuestion(json, html, qid)   		
		    	} else if (equal3) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "password";		    

		    		setFormQuestion(json, html, qid)		
		    	} else if (equal4) {
		    		html = json.question_type.html_tag.replace("[divider]", json.question);;		    		

		    		console.log(html);

		    		$(html).appendTo(element);

		    	} else {
		    		var setting = json.setting;
					html = setting.html_tag.split(";");	

					qid = "id_question_"+json.id;

					setFormQuestion(json, html, qid)
		    	}		    	
		    	
		    }	   

		    $(	"<div class='form-group'>"+
					"<input class='btn btn-primary form-control' type='submit' value='submit'>"+
				"</div>").appendTo(element);
	    });

	    function setFormQuestion(json, html, qid) {	    	
	    	var list_answer = json.list_answer;					
			var options = "";
			if (list_answer.length>0) {					
				for (u = 0; u < list_answer.length; u++) { 			
					var answer = list_answer[u];
					options += answer.options_tag.replace("[value]", answer.id).replace("[answer]", answer.answer).replace("[name]", qid)
				}	    
			}

			$(	"<div class='form-group'>"+
					"<label for='qid'>"+json.question+" :</label><br>"+				
						html[0].replace("[name]", qid)+
						options+
						html[1]+	    		
				"</div>").appendTo(element);
	    }
	</script>
</body>
</html>