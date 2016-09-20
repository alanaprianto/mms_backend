<div class="form-group">
	{!! Form::label('question', 'Question:') !!}
	{!! Form::text('question', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('group_question', 'Group Question:') !!}
	{!! Form::select('group_question', $gqs, null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('type', 'Question Type:') !!}
	{!! Form::select('type', $types, null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('answer_type', 'Answer Type:') !!}
	{!! Form::select('answer_type', $ats, null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('rules', 'Question Rules:') !!}
	<p>
	@foreach ($rules as $key => $rule)						
        {!! Form::checkbox('rules[]', $rule->id, $rules) !!}  {{$rule->name}}<p>
    @endforeach
</div> 

<div class="form-group">
	{!! Form::label('order', 'Order Question:') !!}
	{!! Form::text('order', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::label('description', 'Description:') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}		
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}	
</div>