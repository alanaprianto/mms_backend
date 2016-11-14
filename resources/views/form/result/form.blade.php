<div class="form-group">
	{!! Form::label('id_question', 'Question', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('id_question', $fqs, null, ['class' => 'form-control', 'onchange' => 'setAnswerType()']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('answer_type', 'Answer Type', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text(null, null, ['class' => 'form-control', 'id' => 'answer_type', 'readonly']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group" id="answer_form">

</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('id_user', 'User', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('id_user', $users, null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	<div class="col-sm-4 col-sm-offset-2">{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}</div>
</div>

<script type="text/javascript">
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

	    	$("<div id='answer_par'>"+	    		
	    		"<label for='answer_value' class='col-sm-2 control-label'> Jawaban "+data.question+" :</label><br>"+
	    		"<div class='col-sm-10'>"+
	    			html[0].replace("[name]", "answer_value")+
	    			options+
	    			html[1]+	    	
	    		"</div>"+
	    	  "</div>").appendTo(element);

	    });
    }
</script>
