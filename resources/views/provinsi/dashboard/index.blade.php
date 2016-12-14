@extends('provinsi.app')

@section('active-dashboard')
	active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
    <ol class="breadcrumb">
      <li>
        <a>Kadin Provinsi</a>
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
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">KTA</span>
          <h5>Generated KTA</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalkta }}</h1>        
        <small>Total Generated KTA</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">KTA</span>
          <h5>Cancelled KTA</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalcancelkta }}</h1>        
        <small>Total Cancelled KTA</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">KTA</span>
          <h5>Request KTA</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalreqkta }}</h1>        
        <small>Total Request KTA</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <span class="label label-success pull-right">KTA</span>
          <h5>Expired KTA</h5>
      </div>
      <div class="ibox-content">
        <h1 class="no-margins">{{ $totalexpkta  }}</h1>        
        <small>Total Expired KTA</small>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
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
          <div class="form-group">
            <label class="col-lg-4 control-label">Username</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $user->username }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Role</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $user->myrole->name }}</p>
            </div>
          </div>          
          <div class="form-group">
            <label class="col-lg-4 control-label">Provinsi</label>
            <div class="col-lg-8">
              <p class="form-control-static">{{ $user->territory_name }}</p>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
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
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
   window.onload = getNews;
    
    function getNews() {
      $.ajax({    
        url: "http://110.74.178.215/portal/kadin-indonesia/list/view_detail/list",
        type: "post",
        data: {
          id: "berita_kadin",
          param: "news",
          sort: "desc",
          order: "year",
          limit: 20,
          offset: 0
        }
      }).done(function(data) {
        var json = JSON.parse(data);
        var datas = json.data;
        var element = document.getElementById("wadahnews");
        
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
              "</div>").appendTo(element);
          }
        }
      });
    }
</script>
@endpush