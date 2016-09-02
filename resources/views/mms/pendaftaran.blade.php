@extends('mms.app')

@section('content')
<div class="well">
	<h1>Form Pendaftaran</h1>
	<br>
	{!! Form::open(['action' => ['PendaftaranController@store'], 'id' => 'wadah']) !!}	
		
	{!! Form::close() !!}
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(window).on('load', function(e) {		
		var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));

		console.log(data);
		var element = document.getElementById("wadah");
	    for (i=0; i<data.length; i++) {
	    	var json = data[i];

	    	var setting = json.setting;
			var list_answer = json.list_answer;					

			var html = setting.html_tag.split(";");

			var options = "";
			if (list_answer.length>0) {					
				for (u = 0; u < list_answer.length; u++) { 			
					var answer = list_answer[u];
					options += answer.options_tag.replace("[value]", answer.id).replace("[answer]", answer.answer).replace("[name]", "id_question_"+json.id)
				}	    
			}

			$(	"<div class='form-group'>"+
					"<label for='id_question_"+json.id+"'>"+json.question+" :</label><br>"+					
						html[0].replace("[name]", "id_question_"+json.id)+
						options+
						html[1]+	    		
				"</div>").appendTo(element);
	    }	   

	    $(	"<div class='form-group'>"+
				"<input class='btn btn-primary form-control' type='submit' value='submit'>"+
			"</div>").appendTo(element);
    });
</script>
@stop