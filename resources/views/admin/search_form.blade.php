<style type="text/css">
	.nopadding {
	   padding-left: 0 !important;
	   margin-left: 0 !important;
	}
</style>
{!! Form::open(['method' => 'GET', 'url' => $formUrl, 'class' => 'form-inline', 'role' => '']) !!}
	<div class="col-sm-4 nopadding" align="left">
		<a href='{{ $createUrl }}' class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah Data</a>
	</div>    
    
    <div class="col-sm-8 nopadding" align="right">
    	@if (str_contains($formUrl, 'result'))
    		<input type="text" name="search" id="search" class="form-control" placeholder="Search Question..." style="width: 500px;">
    	@else 
    		<input type="text" name="search" id="search" class="form-control" placeholder="Search..." style="width: 500px;">
    	@endIf

	    
	    <button class="btn btn-submit-md" type="submit">
	      <span class="glyphicon glyphicon-search">
	    </button> 
    </div>
    
{!! Form::close() !!}

<br><br><br>