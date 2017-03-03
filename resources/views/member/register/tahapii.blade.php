@extends('common.app')

@section('content')
<div id="breadcrumbs-bar" class="col-lg-10">
  <h2>Anggota Biasa</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li>
      <a>Profile</a>
    </li>
    <li class="active">
      <strong>Profile Completion</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <strong>Update Profile Information</strong><br/>
        <small>Silahkan melengkapi form dibawah ini !</small>
      </div>
      <div class="ibox-content">
        @include('errors.error_list')

        {!! Form::open(['url' => ['registerii', 0], 'id' => 'wadah']) !!}
                                
		{!! Form::close() !!}
      </div>
    </div>
  </div>

<!-- KBLI Modal -->
<div class="modal inmodal" id="kbliModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>        
        <h4 class="modal-title">Pencarian KBLI</h4>    
      </div>
      <div class="modal-body">
        <p>Silakan memilih KBLI yang tersedia di bawah ini.</p>
        <div class="">
          <form id="frmTemp" method="post" action="">            
            <select id="pilKbli1" class="form-control" onchange="setKbli('pilKbli2', '2', this.value);">
              <!-- <option value="" selected="">=== KBLI 1 ===</option>
              <option value="A">A # PERTANIAN, KEHUTANAN DAN PERIKANAN</option>
              <option value="B">B # PERTAMBANGAN DAN PENGGALIAN</option>
              <option value="C">C # INDUSTRI PENGOLAHAN</option>
              <option value="D">D # PENGADAAN LISTRIK, GAS, UAP/AIR PANAS DAN UDARA DINGIN</option>
              <option value="E">E # PENGADAAN AIR, PENGELOLAAN SAMPAH DAN DAUR ULANG,...</option>
              <option value="F">F # KONSTRUKSI</option>
              <option value="G">G # PERDAGANGAN BESAR DAN ECERAN; REPARASI DAN PERAWATAN MOBIL...</option>
              <option value="H">H # TRANSPORTASI DAN PERGUDANGAN</option>
              <option value="I">I # PENYEDIAAN AKOMODASI DAN PENYEDIAAN MAKAN MINUM</option>
              <option value="J">J # INFORMASI DAN KOMUNIKASI</option>
              <option value="K">K # JASA KEUANGAN DAN ASURANSI</option>
              <option value="L">L # REAL ESTAT</option>
              <option value="M">M # JASA PROFESIONAL, ILMIAH DAN TEKNIS</option>
              <option value="N">N # JASA PERSEWAAN DAN SEWA GUNA USAHA TANPA HAK OPSI,...</option>
              <option value="O">O # ADMINISTRASI PEMERINTAHAN, PERTAHANAN DAN JAMINAN SOSIAL...</option>
              <option value="P">P # JASA PENDIDIKAN</option>
              <option value="Q">Q # JASA KESEHATAN DAN KEGIATAN SOSIAL</option>
              <option value="R">R # KESENIAN, HIBURAN DAN REKREASI</option>
              <option value="S">S # KEGIATAN JASA LAINNYA</option>
              <option value="T">T # JASA PERORANGAN YANG MELAYANI RUMAH TANGGA; KEGIATAN YANG...</option>
              <option value="U">U # KEGIATAN BADAN INTERNASIONAL DAN BADAN EKSTRA INTERNASIONAL...</option> -->
            </select>            
            <br>
            <select id="pilKbli2" class="form-control" onchange="setKbli('pilKbli3', '3', this.value);">
              <option value='' selected>=== KBLI 2 ===</option>
            </select>
            <br>
            <select id="pilKbli3" class="form-control" onchange="setKbli('pilKbli4', '4', this.value);">
              <option value='' selected>=== KBLI 3 ===</option>
            </select>
            <br>
            <select id="pilKbli4" class="form-control" onchange="setKbli('pilKbli5', '5', this.value);">
              <option value='' selected>=== KBLI 4 ===</option>
            </select>
            <br>
            <select id="pilKbli5" class="form-control" onchange="setKblitxt(this.value);">
              <option value='' selected>=== KBLI 5 ===</option>
            </select>            
            <br><br>
            <div class="form-group">
              <label for="thkbli" align="center">Kode KBLI</label><br>
              <input type="text" id="thekbli" class="form-control" value="" style="text-align:center;font-size: 24px; font-family: monospace;color:#0000ff; background-color:#eeeeee;" readonly>
            </div>
            <br><br>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
        <button id="btnKbli" type="button" class="btn btn-primary">Pilih</button>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
    @include('scripts.setkbli_script')
	<script type="text/javascript">
		function resizeIframe(obj) {
	      console.log(obj.contentWindow.document.body.scrollHeight);
	      obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	    }

	    var data = JSON.parse("{{ $fquestions }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
        var answers = JSON.parse("{{ $fresults }}".replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>'));

        $(window).on('load', function(e) {      
            // console.log($(window).contentWindow.document.body.scrollHeight);                         

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

                    setFormQuestion(json, html, qid)        
                } else if (equal2) {
                    html = json.question_type.html_tag.split(";");
                    qid = "password_confirmation";       

                    setFormQuestion(json, html, qid)        
                } else if (equal3) {
                    html = json.question_type.html_tag.split(";");
                    qid = "password";           

                    setFormQuestion(json, html, qid)        
                } else if (equal4) {
                    html = json.question_type.html_tag.replace("[divider]", json.question); 

                    $(html).appendTo(element);

                } else if (equal5) {
                    html = json.question_type.html_tag.replace("[divider]", "");                    

                    $(html).appendTo(element);

                } else if (equal6) {
                    html = json.question_type.html_tag.split(";");
                    qid = "name";           

                    setFormQuestion(json, html, qid)
                } else if (equal7) {
                    html = json.question_type.html_tag.split(";");
                    qid = "email";          

                    setFormQuestion(json, html, qid)
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

                    var valueP = "";
                    var valueK = "";
                    var valueA = "";
                    var valuePos = "";

                    for (var u = answers.length - 1; u >= 0; u--) {
                        var answer = answers[u];
                        if (answer.question == "Provinsi") {
                            valueP = answer.answer_value;
                        } else if (answer.question == "Kabupaten / Kota") {
                            valueK = answer.answer_value;
                        } else if (answer.question == "Alamat Lengkap") {
                            valueA = answer.answer_value;
                        } else if (answer.question == "Kode Pos") {
                            valuePos = answer.answer_value;
                        }
                    }                                           

                    $(  "<div class='form-group'>"+
                            "<label for=id_question_Provinsi>Provinsi</label>"+
                            req+
                            "<select class=form-control name='id_question_Provinsi' id='provinsi' onchange='setDaerah(this.value)'>"+   
                            "</select>"+
                        "</div>").appendTo(element);

                    $(  "<div class='form-group'>"+
                            "<label for='id_question_KabKot'>Kabupaten / Kota</label>"+
                            req+
                            "<select class=form-control name='id_question_KabKot' id='daerah'>"+
                            "</select>"+
                        "</div>").appendTo(element);

                    $(  "<div class='form-group'>"+
                            "<label for='id_question_Alamat'>Alamat Lengkap</label>"+
                            req+
                            "<textarea class=form-control name='id_question_Alamat'>"+valueA+"</textarea>"+ 
                        "</div>").appendTo(element);

                    $(  "<div class='form-group'>"+
                            "<label for='id_question_KodePos'>Kode Pos</label>"+
                            req+
                            "<input type=text class=form-control name='id_question_KodePos' value='"+valuePos+"'>"+
                        "</div>").appendTo(element);        

                    setProvinsi(valueP, valueK);
                } else {
                    var setting = json.setting;
                    html = setting.html_tag.split(";"); 

                    qid = "id_question_"+json.id;

                    setFormQuestion(json, html, qid);
                }                                   
            }      

            $(  "<div class='form-group'>"+
                    "<input class='btn btn-primary full-width' type='submit' value='Submit'>"+
                "</div>").appendTo(element);

            var div1 = element.offsetHeight;
            var div2 = document.getElementById('page-wrapper').offsetHeight;
            var divh = div1 + div2;
            document.getElementById('page-wrapper').style.height = divh + 'px';
        });

        function setFormQuestion(json, html, qid) {

            var element = document.getElementById("wadah");

            var list_answer = json.list_answer;                 
            var options = "";

            var value = "";

            for (var u = answers.length - 1; u >= 0; u--) {
                var answer = answers[u];
                if (answer.question == json.question) {
                    value = answer.answer_value;
                }                   
            }

            if (list_answer.length>0) {
                for (u = 0; u < list_answer.length; u++) {
                    var answer = list_answer[u];
                    if (answer.id == value) {
                        options += answer.options_tag
                                .replace("[value]", answer.id)
                                .replace("[answer]", answer.answer)
                                .replace("[name]", qid)
                                .replace(">", " selected='selected'>");
                    } else {
                        options += answer.options_tag
                                .replace("[value]", answer.id)
                                .replace("[answer]", answer.answer)
                                .replace("[name]", qid);
                    }
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

            var text_value = "";
            var input_value = ">";
            if (html[0].indexOf("textarea") !== -1) {
                text_value = value;             
            } else if (html[0].indexOf("select") == -1) {
                input_value = " value='"+value+"'>";                        
            }

            $(  "<div class='form-group'>"+
                    "<label for='"+qid+"'>"+json.question+" :</label>"+
                        req+"<br>"+
                        html[0].replace("[name]>", qid+input_value)+
                        options+
                        text_value+
                        html[1].replace("[name]>", qid+input_value)+                               
                "</div>").appendTo(element);
        }

        function setProvinsi(selected, daerah) {            
            $.ajax({
                url: "{{ url('ajax/listprovinsi') }}"
            }).done(function(datas) {
                var element = document.getElementById("provinsi");
                for (u=0; u<datas.length; u++) {                    
                    if (datas[u].id==selected) {                        
                        $(
                            "<option value='"+datas[u].id+"' selected='selected'>"+datas[u].provinsi+"</option>"
                            ).appendTo(element);
                        setDaerah(selected, daerah);
                    } else {                        
                        $("<option value='"+datas[u].id+"'>"+datas[u].provinsi+"</option>").appendTo(element);
                    }                   
                }                                                           
            });             
        }

        function setDaerah(value, selected) {                   
            $.ajax({
                url: "{{ url('ajax/listdaerah') }}" + "/" + value
            }).done(function(datas) {  
                clearElement("daerah");
                var element = document.getElementById("daerah");                    
                for (u = 0; u < datas.length; u++) {        
                    if (datas[u].id==selected) {
                        $("<option value='"+datas[u].id+"' selected='selected'>"+datas[u].daerah+"</option>").appendTo(element);
                    } else {
                        $("<option value='"+datas[u].id+"'>"+datas[u].daerah+"</option>").appendTo(element);
                    }                           
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
	</script>
@endpush