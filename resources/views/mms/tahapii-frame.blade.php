<!DOCTYPE html>
<html lang="en">

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Add Your favicon here -->
    <!--<link rel="icon" href="img/favicon.ico">-->

    <title>KEANGGOTAAN KADIN</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/assets/css/register/style.css') }}" rel="stylesheet">
</head>
<body id="page-top">

  <section class="features">
    <div class="container">
        <div class="row features-block">
            <!--<div class="col-lg-12 features-text wow fadeInLeft">-->
            <div class="col-lg-12 features-text wow fadeInLeft">
                <strong>Update Profile Information</strong><br/>
                <small>Silahkan melengkapi form dibawah ini !</small><br/><br/>
                @include('errors.error_list')

                {!! Form::open(['action' => ['PendaftaranController@storeii'], 'id' => 'wadah']) !!}    
                                
                {!! Form::close() !!}
            </div>
        </div>
    </div>
  </section>

<script src="{{ asset('resources/assets/js/jquery-2.1.1.js') }}"></script>
<script type="text/javascript">
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
                    options += answer.options_tag
                                .replace("[value]", answer.id)
                                .replace("[answer]", answer.answer)
                                .replace("[name]", qid);

                    if (answer.id == value) {
                        options.replace(">", " selected='selected'>");
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

            console.log("<div class='form-group'>"+
                    "<label for='"+qid+"'>"+json.question+" :</label>"+
                        req+"<br>"+
                        html[0].replace("[name]", qid).replace(">", input_value)+
                        options+
                        text_value+
                        html[1]+                                
                "</div>");
            $(  "<div class='form-group'>"+
                    "<label for='"+qid+"'>"+json.question+" :</label>"+
                        req+"<br>"+
                        html[0].replace("[name]", qid).replace(">", input_value)+
                        options+
                        text_value+
                        html[1]+                                
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
</body>

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
</html>