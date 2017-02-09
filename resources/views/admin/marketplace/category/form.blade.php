<div class="form-group">
	{!! Form::label('title', 'Title', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('title', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('parent_id', 'Parent', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('parent_id', $cat, null, ['class' => 'form-control', 'onchange' => 'setStatus(this.value)']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::textarea('description', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('status', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	<div class="col-sm-4 col-sm-offset-2">{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}</div>
</div>

<script type="text/javascript">
    function setStatus(value) {
    	var element = document.getElementById('status');
    	if (value==0) {
    		element.value = 'parent';
    	} else {
    		element.value = 'on';
    	}
    }
</script>
