<li class="@yield('active-dashboard')">
	<a href="{{ url('member/dashboard')}}">
		<i class="fa fa-dashboard"></i>
		<span class="nav-label">Dashboard</span>
	</a>
</li>
<li class="@yield('active-kta')">
	<a href="{{ url('member/kta')}}">
		<i class="fa fa-credit-card"></i>
		<span class="nav-label">KTA</span>
	</a>
</li>
<li class="@yield('active-rn')">
	<a href="{{ url('member/rn')}}">
		<i class="fa fa-list-alt"></i>
		<span class="nav-label">National Registration</span>
	</a>
</li>
<li class="@yield('active-compprof')">
	<a href="{{ url('member/compprof')}}">
		<i class="fa fa-user"></i>
		<span class="nav-label">Company Profile</span>
	</a>
</li>
<li class="@yield('active-market')">
	<a href="{{ url('member/marketplace')}}">
		<i class="fa fa-shopping-cart"></i>
		<span class="nav-label">Marketplace</span>
	</a>
</li>