@extends('daerah.app')

@section('sidebar')
  @include('daerah.register.sidebar')
@stop

@section('content')
<div class="col-lg-10">
  <h2>Pendaftaran Anggota Biasa</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>        
    <li class="active">
      <strong>Pendaftaran</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
	<iframe src="{{ url('register1frame') }}" frameborder='0' width='100%' onload='resizeIframe(this)'>	
	</iframe>
@stop

@push('scripts')
	<script type="text/javascript">
		function resizeIframe(obj) {
	      console.log(obj.contentWindow.document.body.scrollHeight);
	      obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	    }

		$(window).on('load', function(e) {		
			// console.log($(window).contentWindow.document.body.scrollHeight);
						
			var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
			
			var element = document.getElementById("wadah");
		    for (i=0; i<data.length; i++) {
		    	var json = data[i];

		    	var type = json.question_type.name;

		    	var equal1 = type.toUpperCase() === "USERNAME";
		    	var equal2 = type.toUpperCase() === "CONFIRM PASSWORD";
		    	var equal3 = type.toUpperCase() === "PASSWORD";
		    	var equal4 = type.toUpperCase() === "DIVIDER TITLE";
		    	var equal5 = type.toUpperCase() === "DIVIDER";		    	
		    	var equal6 = type.toUpperCase() === "NAME";
		    	var equal7 = type.toUpperCase() === "EMAIL";
		    	var equal8 = type.toUpperCase() === "ADDRESS";

		    	var html = "";
		    	var qid = "";

		    	if (equal1) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "username";		    

		    		setFormQuestion(json, html, qid);		
		    	} else if (equal2) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "password_confirmation";		 

		    		setFormQuestion(json, html, qid);  		
		    	} else if (equal3) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "password";		    

		    		setFormQuestion(json, html, qid);		
		    	} else if (equal4) {
		    		html = json.question_type.html_tag.replace("[divider]", json.question);	

		    		$(html).appendTo(element);

		    	} else if (equal5) {
		    		html = json.question_type.html_tag.replace("[divider]", "");		    		

		    		$(html).appendTo(element);

		    	} else if (equal6) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "name";		    

		    		setFormQuestion(json, html, qid);
		    	} else if (equal7) {
		    		html = json.question_type.html_tag.split(";");
		    		qid = "email";		    

		    		setFormQuestion(json, html, qid);
		    	} else if (equal8) {
		    		var rules = json.rules_detail;
					var req = "";			
					if (rules) {
						for (var u = rules.length - 1; u >= 0; u--) {
							var rule = rules[u]
							if (rule.name.toUpperCase()==="REQUIRED") {
								req = "<font color='red' size='3'>*</font>";
							}
						}
					}	

		    		$(	"<div class='form-group'>"+
							"<label for=id_question_Provinsi>Provinsi</label>"+
							req+
							"<select class=form-control name='id_question_Provinsi' id='provinsi' onchange='setDaerah(this.value)'>"+	
							"</select>"+
						"</div>").appendTo(element);

					$(	"<div class='form-group'>"+
							"<label for='id_question_KabKot'>Kabupaten / Kota</label>"+
							req+
							"<select class=form-control name='id_question_KabKot' id='daerah'>"+
							"</select>"+
						"</div>").appendTo(element);

					$(	"<div class='form-group'>"+
							"<label for='id_question_Alamat'>Alamat Lengkap</label>"+
							req+
							"<textarea class=form-control name='id_question_Alamat'></textarea>"+	
						"</div>").appendTo(element);

					$(	"<div class='form-group'>"+
							"<label for='id_question_KodePos'>Kode Pos</label>"+
							req+
							"<input type=text class=form-control name='id_question_KodePos'>"+							
						"</div>").appendTo(element);		

					setProvinsi();
		    	} else {
		    		var setting = json.setting;
					html = setting.html_tag.split(";");	

					qid = "id_question_"+json.id;

					setFormQuestion(json, html, qid)
		    	}		    	
		    	
		    }	   

		    $(	"<div class='form-group'>"+
					"<input class='btn btn-primary full-width' type='submit' value='Submit'>"+
				"</div>").appendTo(element);
	    });

	    function setFormQuestion(json, html, qid) {
	    	var element = document.getElementById("wadah");

	    	var list_answer = json.list_answer;					
			var options = "";
			if (list_answer.length>0) {					
				for (u = 0; u < list_answer.length; u++) { 			
					var answer = list_answer[u];
					options += answer.options_tag.replace("[value]", answer.id).replace("[answer]", answer.answer).replace("[name]", qid)
				}	    
			}

			var rules = json.rules_detail;
			var req = "";			
			if (rules) {
				for (var i = rules.length - 1; i >= 0; i--) {
					var rule = rules[i]
					if (rule.name.toUpperCase()==="REQUIRED") {
						req = "<font color='red' size='3'>*</font>";
					}
				}
			}			
			

			$(	"<div class='form-group'>"+
					"<label for='"+qid+"'>"+json.question+" :</label>"+
						req+"<br>"+
						html[0].replace("[name]", qid)+
						options+
						html[1]+	    		
				"</div>").appendTo(element);
	    }

	    function setProvinsi() {	    	
	    	$.ajax({
				url: "{{ url('ajax/listprovinsi') }}"
			}).done(function(datas) {
				var element = document.getElementById("provinsi");
				for (u=0; u<datas.length; u++) {
					$("<option value='"+datas[u].id+"'>"+datas[u].provinsi+"</option>").appendTo(element);
				}															
			});  	    	
	    }

	    function setDaerah(value) {    	
			$.ajax({
		        url: "{{ url('ajax/listdaerah') }}" + "/" + value
		    }).done(function(datas) {  
		    	clearElement();     		  
		    	var element = document.getElementById("daerah");  			    	
				for (u = 0; u < datas.length; u++) { 				   	
					$("<option value='"+datas[u].id+"'>"+datas[u].daerah+"</option>").appendTo(element);
				}						    	      		    	
		    });   
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
@endpush