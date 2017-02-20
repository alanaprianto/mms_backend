<li class="@yield('active-dashboard')">
  <a href="{{ url('pusat/dashboard') }}">
	  <i class="fa fa-dashboard"></i>
	  <span class="nav-label">Dashboard</span>
  </a>
</li>
<li class="@yield('active-groupnr')">
  <a href="#">
  	<i class="fa fa-list-alt"></i>
  	<span class="nav-label">National Register</span>
  	<span class="fa arrow"></span>
  </a>
  <ul class="nav nav-second-level">
  	<li class="@yield('active-nrlist')"><a href="{{ url('pusat/rn/list') }}">List NR</a></li>
    <li class="@yield('active-nrreq')"><a href="{{ url('pusat/rn/request') }}">NR Number Request</a></li> 
  </ul>
</li>
<li class="@yield('active-ktaext')">
  <a href="{{ url('pusat/ktaext') }}">
    <i class="fa fa-dashboard"></i>
    <span class="nav-label">KTA Extension Request</span>
  </a>
</li>