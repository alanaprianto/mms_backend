<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::text('name', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::text('email', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::textarea('address', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::textarea('description', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('position', 'Position', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::select('position', $position, null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}</div>
</div>

<script type="text/javascript">

</script>
