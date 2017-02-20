@extends('daerah.app')

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
@stop

@push('scripts')
<!-- ChartJS--> 
<script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
<script type="text/javascript">
   window.onload = getNews(0);
    
    function getNews($offset) {
      $.ajax({    
        url: "https://devtes.com/portal/kadin-indonesia/list/view_detail/list",
        type: "post",
        data: {
          id: "berita_kadin",
          param: "news",
          sort: "desc",
          order: "year",
          limit: 20,
          offset: $offset
        }
      }).done(function(data) {
        var json = JSON.parse(data);
        var datas = json.data;
        var enews = document.getElementById("wadahnews");
        var epag = document.getElementById("wadahpagination");
        
        enews.innerHTML = "";
        epag.innerHTML = "";

        var pagination = view_pagination(json.numpage, json.ap);
        $(pagination).appendTo(epag);

        for (var i = datas.length - 1; i >= 0; i--) {
          var thedata = datas[i];
          var news = thedata.datas;

          for (var i = news.length - 1; i >= 0; i--) {
            var thenews = news[i];
            var link = thenews.title.replace(/\s+/g, "_");
            var judul = thenews.title;
            var tagline = thenews.tagline;
            var date_publish = thenews.datepublish;

            $("<div class='feed-element'>"+
                "<div>"+
                  "<a target=_blank href='https://devtes.com/portal/kadin-indonesia/news/berita_kadin/"+link+"'>"+
                    "<i class='fa fa-envelope fa-fw'></i>"+
                    "<strong>"+judul+"</strong>"+
                  "</a>"+
                  "<small class='pull-right text-navy'></small>"+
                  "<div>"+tagline+"</div>"+
                  "<small class='text-muted'>"+date_publish+"</small>"+
                "</div>"+
              "</div>").appendTo(enews);
          }
        }
      });
    }

    function view_pagination($numpage, $active)
    {
      var pagination = '';
      var class_active = '';
      var start_number = $active-2;
      
      var next = '';

      if ($active < 3)
      {
        start_number = 1;
      }

      var end_number = $numpage - start_number;
      number_list = $numpage;
      if (end_number >= 4)
      {
        number_list = start_number + 4;
        var next = '<li class="c-next"><a class="upage" href="#" onClick="getNews('+(number_list)+')" data-offset="'+(number_list)+'"><i class="fa fa-angle-right"></i></a></li>';
      }

      var prev = '';
      if (start_number > 1)
      {
        var prev = '<li class="c-prev"><a class="upage" href="#" onClick="getNews('+(start_number-2)+')" data-offset="'+(start_number-2)+'"><i class="fa fa-angle-left"></i></a></li>';
      }

      for(i=start_number; i <= number_list; i++)
      {
        var class_active = '';
        if (i == $active)
        {
          class_active = 'class="c-active"';
        }
        pagination = pagination+'<li '+class_active+'><a class="upage" href="#" onClick="getNews('+(i-1)+')" data-offset="'+(i-1)+'">'+i+'</a></li>';
      }
      return prev+pagination+next;
    }    

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