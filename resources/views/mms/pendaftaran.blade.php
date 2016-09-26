@extends('mms.app')

@section('content')		
<section class="mbr-section" id="msg-box8-0" style="background-color: rgb(40, 38, 44); padding-top: 160px; padding-bottom: 120px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);">

    </div>
    <div class="container">
        <div class="card card-block" style="margin-top: -100px; margin-left: 100px; margin-right:100px; margin-bottom:-80px;">
			<h2>Form Pendaftaran</h2>
			<br>
			
			@include('errors.error_list')
			
			{!! Form::open(['action' => ['PendaftaranController@store'], 'id' => 'wadah']) !!}	
				
			{!! Form::close() !!}			
		</div>
    </div>

</section>	
@stop

@section('scripts')
	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function(event) { 
		  	function asdad(value) {
		    	console.log(value);
		    }
		});

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
					"<input class='btn btn-primary form-control' type='submit' value='Submit'>"+
				"</div>").appendTo(element);

		    asdad("asdad");
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
						req = "<font color='red' size='6'>*</font>";
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
@stop