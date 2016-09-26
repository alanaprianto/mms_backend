
<html>
<head>	
	<!-- Bootstrap Core CSS -->
	<link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{ asset('resources/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<!-- Gritter -->
	<link href="{{ asset('resources/assets/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
	<link href="{{ asset('resources/assets/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
	<div class="col-md-12">
		<div class="well">
			<h1>Form Pendaftaran</h1>
			<br>
			@include('errors.error_list')

				{!! Form::open(['action' => ['PendaftaranController@store'], 'id' => 'wadah']) !!}	
					
			{!! Form::close() !!}
		</div>	
	</div>	

	<!-- JQuery -->
    <script src="{{ asset('resources/assets/js/jquery-3.1.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
	<script src="{{ asset('resources/assets/js/bootstrap.js') }}"></script>

	<script type="text/javascript">
		$(window).on('load', function(e) {		
			var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
			
			var element = document.getElementById("wadah");
		    for (i=0; i<data.length; i++) {
		    	var json = data[i];

		    	var type = json.question_type.name;

		    	var equal1 = type.toUpperCase() === "USERNAME";
		    	var equal2 = type.toUpperCase() === "CONFIRM PASSWORD";
		    	var equal3 = type.toUpperCase() === "PASSWORD";
		    	var equal4 = type.toUpperCase() === "DIVIDER TITLE";
		    	var equal5 = type.toUpperCase() === "DIVIDER";
		    	var equal6 = type.toUpperCase() === "QUESTION";
		    	var equal7 = type.toUpperCase() === "NAME";
		    	var equal8 = type.toUpperCase() === "EMAIL";

		    	var html = "";
		    	var qid = "";

		    	if (equal1) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "username";		    

		    		setFormQuestion(json, html, qid);		
		    	} else if (equal2) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "password_confirmation";		 

		    		setFormQuestion(json, html, qid);  		
		    	} else if (equal3) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "password";		    

		    		setFormQuestion(json, html, qid);		
		    	} else if (equal4) {
		    		html = json.question_type.html_tag.replace("[divider]", json.question);	

		    		$(html).appendTo(element);

		    	} else if (equal5) {
		    		html = json.question_type.html_tag.replace("[divider]", "");		    		

		    		$(html).appendTo(element);

		    	} else if (equal7) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "name";		    

		    		setFormQuestion(json, html, qid);
		    	} else if (equal8) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "email";		    

		    		setFormQuestion(json, html, qid);
		    	} else {
		    		var setting = json.setting;
					html = setting.html_tag.split(";");	

					qid = "id_question_"+json.id;

					setFormQuestion(json, html, qid)
		    	}		    	
		    	
		    }	   

		    $(	"<div class='form-group'>"+
					"<input class='btn btn-primary full-width' type='submit' value='Submit'>"+
				"</div>").appendTo(element);
	    });

	    function setFormQuestion(json, html, qid) {
	    	var element = document.getElementById("wadah");

	    	var list_answer = json.list_answer;					
			var options = "";
			if (list_answer.length>0) {					
				for (u = 0; u < list_answer.length; u++) { 			
					var answer = list_answer[u];
					options += answer.options_tag.replace("[value]", answer.id).replace("[answer]", answer.answer).replace("[name]", qid)
				}	    
			}

			var rules = json.rules_detail;
			var req = "";			
			if (rules) {
				for (var i = rules.length - 1; i >= 0; i--) {
					var rule = rules[i]
					if (rule.name.toUpperCase()==="REQUIRED") {
						req = "<font color='red' size='3'>*</font>";
					}
				}
			}			
			

			$(	"<div class='form-group'>"+
					"<label for='"+qid+"'>"+json.question+" :</label>"+
						req+"<br>"+
						html[0].replace("[name]", qid)+
						options+
						html[1]+	    		
				"</div>").appendTo(element);
	    }
	</script>
</body>