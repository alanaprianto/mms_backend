<!-- Insert Modal -->
<div class="modal inmodal" id="insertModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content animated bounceInRight">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">
		  <span aria-hidden="true">&times;</span>
		  <span class="sr-only">Close</span>
		</button>		
		<h4 class="modal-title">Pernyataan</h4>		
	  </div>
	  <div class="modal-body">
		<p>Bersama ini kami menyatakan pemahaman kami bahwa:</p>
		<p align="justify">
			<ul>
				<li align="justify">Kamar Dagang dan Industri (KADIN) merupakan satu-satunya organisasi sebagai wadah pengusaha Indonesia dan bergerak dalam bidang perekonomian yang ditetapkan berdasarkan Undang-Undang Republik Indonesia Nomor 1 Tahun 1987, dan Keputusan Presiden Republik Indonesia Nomor 17 Tahun 2010 tentang persetujuan perubahan anggaran dasar dan anggaran rumah tangga KADIN.</li>
				<li align="justify">Dengan Undang-Undang tersebut ditetapkan adanya satu Kamar dagang dan Industri yang merupakan wadah bagi pengusaha Indonesia, baik yang bergabung maupun yang tidak bergabung dalam organisasi pengusaha dan/atau organisasi perusahaan</li>
				<li align="justify">Kamar Dagang Industri bersifat mandiri, bukan organisasi pemerintah dan bukan organisasi politik serta dalam kegiatannya tidak mencari keuntungan.</li>
				<li align="justify">Setiap pengusaha Indonesia serta organisasi perusahaan dan organisasi pengusaha harus menjadi anggota KADIN dengan mendaftar pada KADIN</li>
			</ul>
		</p>
		<p align="justify">Berkenaan dengan hal tersebut, semua data dan informasi yang telah kami sampaikan mengenai perusahaan/organisasi kami dalam rangka permohonan untuk menjadi anggota KADIN adalah lengkap, mutakhir/terbaru dan benar. Apabila diperlukan, kami siap untuk menyampaikan dokumen-dokumen pendukung atas keterangan yang telah kami sampaikan dan siap menerima akibat sesuai pedoman organisasi yang berlaku dari penyampaian keterangan/informasi yang salah.</p>
		<div class="checkbox form-control bg-warning">
	      <label>
	      	<input type="checkbox" id="agree" value="1">
	      	Saya setuju dengan pernyataan tersebut.
	      </label>
	    </div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		<button id="btnsubmit" type="button" class="btn btn-primary" disabled>Daftar</button>
	  </div>
	</div>
  </div>
</div>

	<script type="text/javascript">
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
		    	var equal9 = type.toUpperCase() === "FILE UPLOAD";

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
		    	} else if (equal9) {		    		
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
					var id = json.id;
					var question = json.question;

		    		$(	"<div class='form-group'>"+
							"<label for='"+id+"'>"+question+"</label>"+
							req+						
							"<div class='input-group file-caption-main'>"+
								"<div class='form-control file-caption  kv-fileinput-caption'>"+
									"<div class='file-caption-name' id='text-"+id+"'>"+
										"<i class='glyphicon glyphicon-file kv-caption-icon'></i>"+										
									"</div>"+
								"</div>"+
								"<div class='input-group-btn'>"+
									"<div class='btn btn-primary btn-file'>"+
										"<i class='glyphicon glyphicon-folder-open'></i>"+
									    "&nbsp;&nbsp;"+
									    "<span class='hidden-xs'>Browse …</span>"+
									    "<input name='id_question_fileupload_"+id+"' type='file' class='file' onchange='setImgText(this, "+id+")'>"+
									"</div>"+
								"</div>"+
							"</div>"+
						"</div>").appendTo(element);


		    	} else {
		    		var setting = json.setting;
					html = setting.html_tag.split(";");	

					qid = "id_question_"+json.id;

					setFormQuestion(json, html, qid)
		    	}		    	
		    	
		    }	   

		    var alb = "{{ $alb }}";
		    if (alb) {
		    	$("<a href='' class='btn btn-primary full-width' data-toggle='modal' data-target='#insertModal' >"+
		    			"Next"+
		    	  "</a>").appendTo(element);				
		    } else {
		    	$(	"<div class='form-group'>"+
						"<input class='btn btn-primary full-width' type='submit' value='Submit'>"+
					"</div>").appendTo(element);
		    }		    
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
						html[1].replace("[name]", qid)+	    		
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
		    	clearElement("daerah");
		    	var element = document.getElementById("daerah");  			    	
				for (u = 0; u < datas.length; u++) { 				   	
					$("<option value='"+datas[u].id+"'>"+datas[u].daerah+"</option>").appendTo(element);
				}						    	      		    	
		    });   
		}

		function clearElement(id) {
	    	var select = document.getElementById(id);
			var i;
		    for(i = select.options.length - 1 ; i >= 0 ; i--)
		    {
		        select.remove(i);
		    }
	    }

	    function setImgText(input, id) {
			console.log(input.files[0].name);

			var filename = input.files[0].name;
			var element = document.getElementById("text-"+id);
	        
			element.innerHTML = 
				"<i class='glyphicon glyphicon-file kv-caption-icon'></i>"+
			   	filename+
			   	"<input name='id_question_"+id+"'' type='hidden' value='"+filename+"'>";


			// if (input.files && input.files[0]) {
	  //       	var reader = new FileReader();

	  //           reader.onload = function (e) {
	  //           	$('#blah').attr('src', e.target.result);
	  //           }

	  //          	reader.readAsDataURL(input.files[0]);
	  //       }
		}		

		$('#btnsubmit').on('click', function (event) {			
			$( "#wadah" ).submit();
		});

		$(function() {
		    $('#agree').change(function() {
		        $('#btnsubmit').attr('disabled', !this.checked);
		    });
		});
	</script>