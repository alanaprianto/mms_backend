@extends('member.app')

@section('head')  
  <link href="{{ asset('resources/assets/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
  <style rel="stylesheet">
    .link
    {
      color:white;
      text-decoration: none;
      background-color: none;
    }
  </style>
@stop

@section('active-dashboard')
  active
@stop

@section('content')
<div class="col-lg-10">
  <h2>Dashboard</h2>
  <ol class="breadcrumb">
    <li>
      <a>Member</a>
    </li>
    <li class="active">
      <strong>Dashboard</strong>
    </li>
  </ol>
</div>
@stop

@section('iframe')
<div class="col-lg-6">
  @if ($corr>0||$comm>0)
  <div class="row link">
    <a href="{{ url('member/compprof') }}">
      <div class="col-lg-6">
        <div class="widget style1 yellow-bg">
          <div class="row">
            <div class="col-xs-4">
              <i class="fa fa-warning fa-5x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <span> Commentary </span>
              <h2 class="font-bold">{{ $comm }}</h2>
            </div>
          </div>
        </div>
      </div>
    </a>
    <div class="col-lg-6">
      <a href="{{ url('member/compprof') }}">
        <div class="widget style1 red-bg">
          <div class="row">
            <div class="col-xs-4">
              <i class="fa fa-warning fa-5x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <span> Correction </span>
              <h2 class="font-bold">{{ $corr }}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>KTA Status</h5>
        </div>
        <div class="ibox-content">
          <h4 align="center">
          @if ($exp_show)
            {{ $exp_text1 }}<br><br>
            <strong>{{ $exp_text2 }}</strong>
            <br><br>
            <a href="{{ url('member/kta') }}">
              <button type="submit" class="btn btn-success">
                See your KTA detail.
              </button>
            </a>
          @else
            @if ($kta=="")
              KTA is not requested.<br>
              Complete your Account Information.
            @elseif ($kta=="requested")
              KTA is requested.<br>
              Waiting for Validation.
            @elseif ($kta=="validated")
              KTA is validated.<br>
              Waiting for Generation.
            @elseif ($kta=="cancelled")
              Your KTA request is cancelled.<br><br>
              <a href="{{ url('member/kta') }}">
                <button type="submit" class="btn btn-danger">
                  See Why your KTA is cancelled.
                </button>
              </a>
            @else
              Your KTA is generated.<br><br>
              <a href="{{ url('member/kta') }}">
                <button type="submit" class="btn btn-success">
                  See your KTA detail.
                </button>
              </a>
            @endif
          @endif
          </h4>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>National Registration</h5>
        </div>
        <div class="ibox-content">
          <h4 align="center">
          @if ($rn=="")
            RN Number is not yet requested.<br>
          @elseif ($rn=="requested")
            RN Number is requested.<br>
            Still in process.
          @elseif ($rn=="cancelled")
            Your RN Number request is cancelled.<br><br>
            <a href="{{ url('member/kta') }}">
              <button type="submit" class="btn btn-danger">
                See Why your RN is cancelled.
              </button>
            </a>
          @else
            Your RN Number is generated.<br><br>
            <a href="{{ url('member/rn') }}">
              <button type="submit" class="btn btn-success">
                See your RN detail.
              </button>
            </a>
          @endif
          </h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
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
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Username</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $member->username }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Tracking Code</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $detail[0]['trackingcode'] }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Submitted At</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $member->created_at }}</p>
                </div>
              </div>          
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Profile Summary</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>          
          </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-12">
              @unless ($percentage == 100 || $percentage == 0)     
                <span class="pull-right">
                  <a href="{{ url('member\registerii') }}">
                    Complete your account Information
                  </a>
                </span>
              @endunless
              <h5>Your Account Information ({{ $completed }}/{{ $required }})</h5>          
              <div class="progress progress-striped active">
                <div style="width: {{ $percentage}}%" aria-valuemax="{{ $required }}" aria-valuemin="0" aria-valuenow="{{ $completed }}" role="progressbar" class="progress-bar progress-bar-success">    
                </div>
              </div>          

              <!-- identitas user -->
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Nama Perusahaan</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $compform }} {{ $compname }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Klasifikasi Perusahaan</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $compclass }}</p>
                </div>
              </div>
              <br>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Daerah</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $daerah }}</p>
                </div>
              </div>
              <div class="form-group col-md-12 no-padding">
                <label class="col-lg-4 control-label no-padding">Provinsi</label>
                <div class="col-lg-8">
                  <p class="form-control-static no-padding">{{ $provinsi }}</p>
                </div>
              </div>            
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
<div class="col-lg-6">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <span class="pull-right">
            <small>({{ $cdoc }}/{{ $rdoc }})</small>
          </span>
          <h5>Documents Uploaded</h5>
        </div>
        <div class="ibox-content">
          <div class="lightBoxGallery">
            @foreach ($docs as $key=>$doc)
              <a href="{{ url('/uploadedfiles') }}/{{ $member->username}}:::{{ explode('.', $doc->answer_value)[0] }}" data-gallery="">
                <img src="{{ url('/uploadedfiles') }}/{{ $member->username}}:::{{ explode('.', $doc->answer_value)[0] }}-thumbs">
              </a>
            @endforeach
            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
            <div id="blueimp-gallery" class="blueimp-gallery">
              <div class="slides"></div>
              <h3 class="title"></h3>
              <a class="prev">‹</a>
              <a class="next">›</a>
              <a class="close">×</a>
              <a class="play-pause"></a>
              <ol class="indicator"></ol>
            </div>
          </div>
          @if ($cdoc==0)
            <h4 align="center">
              <a href="{{ url('member\completeprofile\18') }}">
                <button type="submit" class="btn btn-success">
                  Upload Scanned Document
                </button>
              </a>
            </h4>
          @endif        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
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
</div>
<div class="row">
</div>
<br><br>
@stop

@push('scripts')
<script src="{{ asset('resources/assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
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
</script>
@endpush