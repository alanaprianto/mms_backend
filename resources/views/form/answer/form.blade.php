<div class="form-group">
	{!! Form::label('answer', 'Answer:') !!}
	{!! Form::text('answer', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('question_id', 'Question :') !!}
	{!! Form::select('question_id', $fqs, null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('options_type', 'Options Type:') !!}
	{!! Form::select('options_type', $ats, null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('description', 'Description:') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}	
</div>