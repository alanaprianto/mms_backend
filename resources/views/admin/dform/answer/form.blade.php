<div class="form-group">
	{!! Form::label('answer', 'Answer', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('answer', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('options_type', 'Options Type', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('options_type', $ats, null, ['class' => 'form-control', 'onchange' => 'setQuestion(this.options[this.selectedIndex].innerHTML)']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('question_id', 'Question', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('question_id', $fqs, null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::textarea('description', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	<div class="col-sm-4 col-sm-offset-2">{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}</div>
</div>

<script type="text/javascript">
    function setQuestion(value) {
    	var type1 = value.split(" ");
    	var type = type1[1];

		console.log("type = "+type);
		$.ajax({
	        url: "{{ url('crud/form/setting/') }}" + "/" + type
	    }).done(function(datas) {
	    	var id = "";
	    	for (i = 0; i < datas.length; i++) {
	    		var data = datas[i];
	    		console.log("Data = "+data);
			    if (data.name.indexOf("Options") == -1) {
					id = data.id;
					console.log("ID = "+ id);
	    		}
			}
	    	$.ajax({
	        url: "{{ url('crud/form/question/whereSetting') }}" + "/" + id
		    }).done(function(datas) {
		    	console.log(datas);
		    	var element = document.getElementById("question_id");
				clearElement();

		    	for (i = 0; i < datas.length; i++) {
		    		var data = datas[i];
				    var id = data.id;
				    var question = data.question;

				    $("<option value="+id+">"+question+"</option>").appendTo(element);
				}
		    });
	    });

    }

    function clearElement() {
    	var select = document.getElementById("question_id");
		var i;
	    for(i = select.options.length - 1 ; i >= 0 ; i--)
	    {
	        select.remove(i);
	    }
    }
</script>
