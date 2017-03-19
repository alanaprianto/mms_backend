<div class="form-group">
	{!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('name', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('username', 'Username', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::text('username', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::email('email', null, ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::password('password', ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<div class="form-group">
	{!! Form::label('role', 'Role', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-4">{!! Form::select('role', $role, null, ['class' => 'form-control', 'onchange' => 'setTerritory(this.value)']) !!}</div>
</div>
<div class="hr-line-dashed"></div>

<!-- ini diisi apa? | di comment dulu -->

<div class="form-group" id="provinsi">

</div>

<div class="form-group" id="daerah">

</div>


<div class="form-group">
  <div class="col-sm-4 col-sm-offset-2">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
  </div>
</div>

<script type="text/javascript">
    function setTerritory(value) {
    	console.log(value);

		var element = document.getElementById("provinsi");
	    var par = document.getElementById("provinsi_filled");
        var par1 = document.getElementById("daerah_filled");

	    if (par) {
			par.remove();
	    }
        if (par1) {
            par1.remove();
        }

	    var daerah = false;
	    var init = false;
		if (value=="5") {
			daerah = true;
			init = true;
		} else if (value=="4") {
			daerah = false;
			init = true;
		} else if (value=="3") {
			daerah = false;
			init = false;
		} else if (value=="1") {
			daerah = false;
			init = false;
		}

		if (init) {
			$.ajax({
		        url: "{{ url('ajax/listprovinsi') }}"
		    }).done(function(datas) {
		    	console.log(datas);
		    	var options = "";
				for (i=0; i<datas.length; i++) {
					options += "<option value='"+datas[i].id+"'>"+datas[i].provinsi+"</option>";
				}

		    	$(	"<div class='form-group' id='provinsi_filled'>"+
						"<label for=territory class='col-sm-2 control-label'>Provinsi</label>"+
						"<div class='col-sm-4'>"+
							"<select class=form-control name='territory' id='provinsi' onchange='setDaerah(this.value, "+daerah+")'>"+
							options+
							"</select>"+
						"</div>"+
					"</div>").appendTo(element);
		    });
		} else {
			$(	"<div class='form-group' id='provinsi_filled'>"+
					"<label for=territory class='col-sm-2 control-label'>Territory</label>"+
					"<div class='col-sm-4'>"+
						"<input type='text' name='territory' class='hidden' value='0' readonly>"+
						"<h4>Indonesia</h4>"+
					"</div>"+
				"</div>").appendTo(element);
		} 
    }

    function setDaerah(value, init) {
    	if (init) {
    		var element = document.getElementById("daerah");
    		var par1 = document.getElementById("daerah_filled");

    		if (par1) {
				par1.remove();
		    }

    		$.ajax({
				url: "{{ url('ajax/listdaerah') }}" + "/" + value
			}).done(function(datas) {
			   	// clearElement();
			   	var options = "";
				for (u=0; u<datas.length; u++) {
					options += "<option value='"+datas[u].id+"'>"+datas[u].daerah+"</option>";
				}

		    	$(	"<div class='form-group' id='daerah_filled'>"+
						"<label for=territory class='col-sm-2 control-label'>Daerah</label>"+
						"<div class='col-sm-4'>"+
							"<select class=form-control name='territory' id='daerah')'>"+
							options+
							"</select>"+
						"</div>"+
					"</div>").appendTo(element);
			});
    	}
	}

	function clearElement() {
		var select = document.getElementById("daerah");
		var i;
		for(i = select.options.length - 1 ; i >= 0 ; i--)
		{
			select.remove(i);
		}
	}
</script>
