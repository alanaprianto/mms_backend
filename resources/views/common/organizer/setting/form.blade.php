<div class="form-group">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::text('title', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('title', 'Short Title', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::text('short_title', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::textarea('description', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('parent', 'Parent', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::select('parent', $parent, null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    {!! Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">{!! Form::text('status', 'aktif', ['class' => 'form-control', 'readonly']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}</div>
</div>

<script type="text/javascript">

</script>
