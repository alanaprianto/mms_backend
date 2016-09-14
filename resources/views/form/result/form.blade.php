<div class="form-group">
	{!! Form::label('id_question', 'Question :') !!}
	{!! Form::select('id_question', $fqs, null, ['class' => 'form-control', 'onchange' => 'setAnswerType()']) !!}
</div>

<div class="form-group">
	{!! Form::label('Answer Type:') !!}
	{!! Form::text(null, null, ['class' => 'form-control', 'id' => 'answer_type', 'readonly']) !!}		
</div>

<div class="form-group" id="answer_form">
		
</div>

<div class="form-group">
	{!! Form::label('id_user', 'User :') !!}
	{!! Form::select('id_user', $users, null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}	
</div>

<script type="text/javascript">
	var fr = "{{ $fr }}";
	$(window).on('load', function(e) {              
        if (fr) {
        	console.log("fr exist; fr = "+fr);
        } else {
        	console.log("fr not exist");
        }
    });

	function setAnswerType() {    	
		var type = document.getElementById("id_question").value;			

		$.ajax({
	        url: "{{ url('crud/form/question/') }}" + "/" + type
	    }).done(function(data) {       
	    	var setting = data.setting;
	    	var list_answer = data.list_answer;

	    	document.getElementById("answer_type").value = setting.name;

			var element = document.getElementById("answer_form");				
	    	var par = document.getElementById("answer_par");

	    	if (par) {
				par.remove();
	    	}

	    	var html = setting.html_tag.split(";");

	    	var options = "";
			for (i = 0; i < list_answer.length; i++) { 
			   	var answer = list_answer[i];
				options += answer.options_tag.replace("[value]", answer.id).replace("[answer]", answer.answer)
			}

	    	$("<p id='answer_par'>"+
	    		"<label for='answer_value'> Jawaban "+data.question+" :</label><br>"+
	    		html[0].replace("[name]", "answer_value")+
	    		options+
	    		html[1]+	    		
	    	  "</p>").appendTo(element);		    	      
	    	
	    });   
    }
</script>