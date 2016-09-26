<div class="form-group">
	{!! Form::label('name', 'Name:') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('description', 'Description:') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('html_tag', 'HTML Tag:') !!}
	{!! Form::textarea('html_tag', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary full-width']) !!}	
</div>