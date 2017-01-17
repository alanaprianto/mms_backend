<li class="@yield('active-dashboard')">
  <a href="{{ url('dashboard/alb') }}">
	  <i class="fa fa-dashboard"></i>
	  <span class="nav-label">Dashboard</span>
  </a>
</li>
<li class="@yield('active-kta')">
	<a href="{{ url('dashboard/alb/kta')}}">
		<i class="fa fa-list-alt"></i>
		<span class="nav-label">KTA</span>
	</a>
</li>
<li class="@yield('active-rn')">
	<a href="{{ url('dashboard/alb/rn')}}">
		<i class="fa fa-list-alt"></i>
		<span class="nav-label">National Registration</span>
	</a>
</li>
<li class="@yield('active-comprof')">
	<a href="{{ url('dashboard/alb/compprof')}}">
		<i class="fa fa-user"></i>
		<span class="nav-label">Company Profile</span>
	</a>
</li>