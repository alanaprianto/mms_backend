<div class="form-group">
	{!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('name', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('parameter', 'Parameter', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('parameter', null, ['class' => 'form-control']) !!}</div>
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
