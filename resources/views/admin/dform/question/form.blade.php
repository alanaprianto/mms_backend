<div class="form-group">
	{!! Form::label('question', 'Question', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('question', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('group_question', 'Group Question', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('group_question', $gqs, null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('type', 'Question Type', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('type', $types, null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('answer_type', 'Answer Type', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::select('answer_type', $ats, null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('rules', 'Question Rules', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
	@foreach ($rules as $key => $rule)
		<div class="checkbox">
		  <label>
		    {!! Form::checkbox('rules[]', $rule->id, false) !!}  {{$rule->name}}
		  </label>
		</div>

  @endforeach
	</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('order', 'Order Question', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('order', null, ['class' => 'form-control']) !!}</div>
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
