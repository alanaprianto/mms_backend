@extends('common.app')

@section('active-dashboard')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
  <ol class="breadcrumb">
    <li>
      <a>Kadin Daerah</a>
    </li>
    <li class="active">
      <strong>Dashboard</strong>
    </li>
  </ol>
</div>
<div class="col-lg-2">
  <div class="title-action">      
  </div>
</div>
@stop

@section('iframe')
<div class="row">
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">        
        <h5>Member</h5>
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
              <td> Submitted Form </td>
              <td class="text-center">{{ $totalsubmitted }}</td>
            </tr>
            <tr>
              <td class="text-center">2</td>
              <td> Member </td>
              <td class="text-center">{{ $totalmember }}</td>
            </tr>
            <tr>
              <td class="text-center">3</td>
              <td> Validated Member </td>
              <td class="text-center">{{ $totalverified }}</td>
            </tr>
            <tr>
              <td class="text-center">4</td>
              <td> Unvalidated Member </td>
              <td class="text-center">{{ $totalunverified }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>At A Glance</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>          
        </div>
      </div>
      <div class="ibox-content">
        <div class="row">
        <div class="col-lg-12">
          <!-- identitas user -->          
          <div class="form-group no-padding">
            <label class="col-lg-4 control-label no-padding">Username</label>
            <div class="col-lg-8">
              <p class="form-control-static no-padding">{{ $user->username }}</p>
            </div>
          </div>
          <div class="form-group no-padding">
            <label class="col-lg-4 control-label no-padding">Role</label>
            <div class="col-lg-8">
              <p class="form-control-static no-padding">{{ $user->myrole->name }}</p>
            </div>
          </div>
          <div class="form-group no-padding">
            <label class="col-lg-4 control-label no-padding">Daerah</label>
            <div class="col-lg-8">
              <p class="form-control-static no-padding">{{ $user->territory_name }}</p>
            </div>
          </div>
          <div class="form-group no-padding">
            <label class="col-lg-4 control-label no-padding">Provinsi</label>
            <div class="col-lg-8">
              <p class="form-control-static no-padding">{{ $provinsi->provinsi }}</p>
            </div>
          </div>          
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Kadin News</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>          
        </div>
      </div>
      <div class="ibox-content">
        <div class="feed-activity-list">
          <div id="wadahnews">
          </div>
          <ul id="wadahpagination" class="pagination c-theme"></ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Submitted Form Statistic ({{ $user->territory_name }})</h5>
        <div class="ibox-tools">
          <!-- button today, monthly, annual -->
        </div>
      </div>
      <div class="ibox-content">
        <div class="m-b-xs">
          <div class="legend">
            <table>
              <tbody>
                <tr>
                  <td style="padding: 5px;">
                    <div style="border:1px solid #000000;padding:1px">
                      <div style="width:4px;height:0;border:5px solid #1ab394;overflow:hidden"></div>
                    </div>
                  </td>
                  <td style="padding: 5px;">
                    Ordinary Member
                  </td>
                </tr>
                <tr>
                  <td style="padding: 5px;">
                    <div style="border:1px solid #000000;padding:1px">
                      <div style="width:4px;height:0;border:5px solid #dcdcdc;overflow:hidden"></div>
                    </div>
                  </td>
                  <td style="padding: 5px;">
                    Extraordinary Member
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div>          
          <canvas id="sfLineChart" height="70"></canvas>
        </div>
        <div class="m-t-md">      
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>Member Statistic ({{ $user->territory_name }})</h5>
        <div class="ibox-tools">
          <!-- button today, monthly, annual -->
        </div>
      </div>
      <div class="ibox-content">
        <div class="m-b-xs">
          <div class="legend">
            <table>
              <tbody>
                <tr>
                  <td style="padding: 5px;">
                    <div style="border:1px solid #000000;padding:1px">
                      <div style="width:4px;height:0;border:5px solid #1ab394;overflow:hidden"></div>
                    </div>
                  </td>
                  <td style="padding: 5px;">
                    Ordinary Member
                  </td>
                </tr>
                <tr>
                  <td style="padding: 5px;">
                    <div style="border:1px solid #000000;padding:1px">
                      <div style="width:4px;height:0;border:5px solid #dcdcdc;overflow:hidden"></div>
                    </div>
                  </td>
                  <td style="padding: 5px;">
                    Extraordinary Member
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div>          
          <canvas id="mbrLineChart" height="70"></canvas>
        </div>
        <div class="m-t-md">      
        </div>
      </div>
    </div>
  </div>
</div>
<br/><br/>
@stop

@push('scripts')
<!-- ChartJS--> 
<script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
<script src="{{ asset('js/getnews.js') }}"></script>
<script type="text/javascript">   
    $.post("{{ url('daerah/chart/sf_stat') }}", {_token: "{{ csrf_token() }}"}, function(result){      
      if (result.success) {        
        var l = result.labels;
        var dab = result.data_ab;
        var dalb = result.data_alb;

          var lineData = {
              labels: l,
              datasets: [               
                  {
                      label: "Example dataset",
                      fillColor: "rgba(26,179,148,0.5)",
                      strokeColor: "rgba(26,179,148,0.7)",
                      pointColor: "rgba(26,179,148,1)",
                      pointStrokeColor: "#fff",
                      pointHighlightFill: "#fff",
                      pointHighlightStroke: "rgba(26,179,148,1)",
                      data: dab
                  },
                  {
                      label: "Example dataset",
                      fillColor: "rgba(220,220,220,0.5)",
                      strokeColor: "rgba(220,220,220,1)",
                      pointColor: "rgba(220,220,220,1)",
                      pointStrokeColor: "#fff",
                      pointHighlightFill: "#fff",
                      pointHighlightStroke: "rgba(220,220,220,1)",
                      data: dalb
                  }
              ]
          };

          var lineOptions = {
              scaleShowGridLines: true,
              scaleGridLineColor: "rgba(0,0,0,.05)",
              scaleGridLineWidth: 1,
              bezierCurve: true,
              bezierCurveTension: 0.4,
              pointDot: true,
              pointDotRadius: 4,
              pointDotStrokeWidth: 1,
              pointHitDetectionRadius: 20,
              datasetStroke: true,
              datasetStrokeWidth: 2,
              datasetFill: true,
              responsive: true,
          };

          var ctx = document.getElementById("sfLineChart").getContext("2d");
          var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
      }
    });

    $.post("{{ url('daerah/chart/member_stat') }}", {_token: "{{ csrf_token() }}"}, function(result){      
      if (result.success) {        
        var l = result.labels;
        var dab = result.data_ab;
        var dalb = result.data_alb;

          var lineData = {
              labels: l,
              datasets: [               
                  {
                      label: "Example dataset",
                      fillColor: "rgba(26,179,148,0.5)",
                      strokeColor: "rgba(26,179,148,0.7)",
                      pointColor: "rgba(26,179,148,1)",
                      pointStrokeColor: "#fff",
                      pointHighlightFill: "#fff",
                      pointHighlightStroke: "rgba(26,179,148,1)",
                      data: dab
                  },
                  {
                      label: "Example dataset",
                      fillColor: "rgba(220,220,220,0.5)",
                      strokeColor: "rgba(220,220,220,1)",
                      pointColor: "rgba(220,220,220,1)",
                      pointStrokeColor: "#fff",
                      pointHighlightFill: "#fff",
                      pointHighlightStroke: "rgba(220,220,220,1)",
                      data: dalb
                  }
              ]
          };

          var lineOptions = {
              scaleShowGridLines: true,
              scaleGridLineColor: "rgba(0,0,0,.05)",
              scaleGridLineWidth: 1,
              bezierCurve: true,
              bezierCurveTension: 0.4,
              pointDot: true,
              pointDotRadius: 4,
              pointDotStrokeWidth: 1,
              pointHitDetectionRadius: 20,
              datasetStroke: true,
              datasetStrokeWidth: 2,
              datasetFill: true,
              responsive: true,
          };

          var ctx = document.getElementById("mbrLineChart").getContext("2d");
          var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
      }
    });
</script>
@endpush