<li class="@yield('active-dashboard')"><a href="{{ url('provinsi/dashboard') }}"><i class="fa fa-dashboard"></i><span class="nav-label">Dashboard</span></a></li>
<li class="@yield('active-groupkta')">
  <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">KTA</span><span class="fa arrow"></span></a>
  <ul class="nav nav-second-level">
  	<li class="@yield('active-ktalist')"><a href="{{ url('provinsi/kta/list') }}">List KTA</a></li>
    <li class="@yield('active-ktareq')"><a href="{{ url('provinsi/kta/request') }}">KTA Request</a></li>
    <li class="@yield('active-ktacncl')"><a href="{{ url('provinsi/kta/cancel') }}">Canceled KTA Request</a></li>
    <li class="@yield('active-ktaexp')"><a href="{{ url('provinsi/kta/expired') }}">KTA Expired</a></li>    
  </ul>
</li>
<li class="@yield('active-valnas')"><a href="{{ url('provinsi/valnas') }}"><i class="fa fa-list-alt"></i><span class="nav-label">Validasi Nasional</span></a></li>