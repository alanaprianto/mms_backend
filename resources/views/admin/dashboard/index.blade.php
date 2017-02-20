@extends('admin.app')

@section('active-dashboard')
	active
@stop

@push('styles')
<link href="{{ asset('resources/assets/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Dashboard</h2>
    <ol class="breadcrumb">
        <li>
            <a>Admin</a>
        </li>        
        <li class="active">
            <strong>Dashboard</strong>
        </li>
    </ol>
  </div>
  <div class="col-lg-2">    
  </div>
</div>

<br>
<div class="row">  
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">        
        <h5>Total Member (By Province)</h5>
      </div>
      <div class="ibox-content">
        <div id="morris-bar-chart"></div>        
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">        
        <h5>Dynamic Forms</h5>
      </div>
      <div class="ibox-content">      
        <table class="table table-hover margin bottom">
          <thead>
            <tr>
              <th style="width: 1%" class="text-center">No.</th>
              <th>Form</th>              
              <th class="text-center">Total Counts</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">1</td>
              <td> Form Setting </td>        
              <td id="txt-totalsetting" class="text-center"></td>              
            </tr>
            <tr>
              <td class="text-center">2</td>
              <td> Form Type </td>              
              <td id="txt-totaltype" class="text-center"></td>              
            </tr>
            <tr>
              <td class="text-center">3</td>
              <td> Form Rules </td>              
              <td id="txt-totalrules" class="text-center"></td>              
            </tr>
            <tr>
              <td class="text-center">4</td>
              <td> Form Question </td>              
              <td id="txt-totalquestion" class="text-center"></td>              
            </tr>
            <tr>
              <td class="text-center">5</td>
              <td> Form Question Group </td>              
              <td id="txt-totalqgroup" class="text-center"></td>              
            </tr>
            <tr>
              <td class="text-center">6</td>
              <td> Form Answer </td>              
              <td id="txt-totalanswer" class="text-center"></td>              
            </tr>
            <tr>
              <td class="text-center">7</td>
              <td> Form Result </td>              
              <td id="txt-totalresult" class="text-center"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">        
        <h5>Member Statistics</h5>
      </div>
      <div class="ibox-content ibox-heading">
        <table width="100%">
          <tbody>
            <tr>
              <td></td>
              <td><h2>New Member</h2></td>
              <td rowspan="2"><h1><div id="txt-newmember" class="stat-percent text-navy"> </div></h1></td>
            </tr>
            <tr>
              <td></td>
              <td><h4>This Month</h4></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="ibox-content">
        <table width="100%">
          <tbody>
            <tr>
              <td></td>
              <td><h2>Total Member</h2></td>
              <td>
                <h1 id="txt-ttlmember" class="no-margins text-right"> </h1>
              </td>
            </tr>            
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">        
        <h5>Company Statistic</h5>
      </div>
      <div class="ibox-content">              
        <!-- <div id="morris-donut-chart" ></div> -->
        <div class="flot-chart-pie-content" id="flot-pie-chart"></div>
      </div>
    </div>
  </div>
</div>
<br/><br/>
@stop

@push('scripts')
<!-- Morris -->
<script src="{{ asset('resources/assets/js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/plugins/morris/morris.js') }}"></script>

<!-- Flot -->
<script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.time.js') }}"></script>

<script type="text/javascript">
$(function() {
  setInterval(function(){
    $.post("{{ url('admin/chart/adm_member') }}", {_token: "{{ csrf_token() }}"}, function(result){
      $("#txt-newmember").html(result.newmember);
      $("#txt-ttlmember").html(result.ttlmember);
    });
    
    $.post("{{ url('admin/chart/adm_dynform') }}", {_token: "{{ csrf_token() }}"}, function(result){
      document.getElementById("txt-totalsetting").innerHTML = result.totalsetting;
      document.getElementById("txt-totaltype").innerHTML = result.totaltype;
      document.getElementById("txt-totalrules").innerHTML = result.totalrules;
      document.getElementById("txt-totalquestion").innerHTML = result.totalquestion;
      document.getElementById("txt-totalqgroup").innerHTML = result.totalqgroup;
      document.getElementById("txt-totalanswer").innerHTML = result.totalanswer;
      document.getElementById("txt-totalresult").innerHTML = result.totalresult;
    });

    $.post("{{ url('admin/chart/adm_donut') }}", {_token: "{{ csrf_token() }}"}, function(result){
      if (result.success) {      
        $(function() {        
          dt = result.datas;          
          var plotObj = $.plot($("#flot-pie-chart"), dt, {
            series: {
              pie: {
                show: true
              }
            },
            grid: {
              hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
              content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
              shifts: {
                  x: 20,
                  y: 0
              },
              defaultTheme: false
            }
          });
        }); 
      }
    });

    $.post("{{ url('admin/chart/adm_dblbar') }}", {_token: "{{ csrf_token() }}"}, function(result){
      if (result.success) {
        $("#morris-bar-chart").empty();
        Morris.Bar({
          element: 'morris-bar-chart',
          data: result.datas,
          xkey: 'prov',
          ykeys: ['ab', 'alb'],
          labels: ['Anggota Biasa', 'Anggota Luar Biasa'],
          hideHover: 'auto',
          resize: true,
          barColors: ['#1ab394', '#cacaca'],
        });
      }
    });
  }, 3000);
});
</script>
@endpush