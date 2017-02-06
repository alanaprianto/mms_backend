<li class="@yield('active-dashboard')">
  <a href="{{ url('alb/dashboard') }}">
	  <i class="fa fa-dashboard"></i>
	  <span class="nav-label">Dashboard</span>
  </a>
</li>
<li class="@yield('active-kta')">
	<a href="{{ url('alb/kta')}}">
		<i class="fa fa-list-alt"></i>
		<span class="nav-label">KTA</span>
	</a>
</li>
<li class="@yield('active-rn')">
	<a href="{{ url('alb/rn')}}">
		<i class="fa fa-list-alt"></i>
		<span class="nav-label">National Registration</span>
	</a>
</li>
<li class="@yield('active-comprof')">
	<a href="{{ url('alb/compprof')}}">
		<i class="fa fa-user"></i>
		<span class="nav-label">Company Profile</span>
	</a>
</li>
<li class="@yield('active-market')">
	<a href="">
		<i class="fa fa-shopping-cart"></i>
		<span class="nav-label">Marketplace</span>
	</a>
</li>