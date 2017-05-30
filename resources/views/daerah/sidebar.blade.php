<li class="@yield('active-dashboard')">
	<a href="{{ url('daerah/dashboard')}}">
		<i class="fa fa-dashboard"></i>
		<span class="nav-label">Dashboard</span>
	</a>
</li>
<li class="@yield('active-register')">
	<a href="#">
		<i class="fa fa-list-alt"></i>
		<span class="nav-label">Pendaftaran</span>
		<span class="fa arrow"></span>
	</a>
	<ul class="nav nav-second-level">
		<li class="@yield('active-register-ab')"><a href="{{ url('daerah/pendaftaran/ab') }}">Anggota Biasa</a></li>
		<li class="@yield('active-register-alb')"><a href="{{ url('daerah/pendaftaran/alb') }}">Anggota Luar Biasa</a></li>
	</ul>
</li>
<li class="@yield('active-groupform')">
  	<a href="#">
  		<i class="fa fa-check-square"></i>
  		<span class="nav-label">Submitted Forms</span>
  		<span class="fa arrow"></span>
  	</a>
  	<ul class="nav nav-second-level">
	  	<li class="@yield('active-formab')"><a href="{{ url('daerah/submitted')}}">Form Anggota Biasa</a></li>
    	<li class="@yield('active-formalb')"><a href="{{ url('daerah/submitted/alb')}}">Form Anggota Luar Biasa</a></li>
  	</ul>
</li>
<li class="@yield('active-groupmember')">
	<a href="#">
  		<i class="fa fa-users"></i>
  		<span class="nav-label">Members</span>
  		<span class="fa arrow"></span>
  	</a>
  	<ul class="nav nav-second-level">
  		<li class="@yield('active-memberab')">
  			<a href="{{ url('common/member')}}">Member Anggota Biasa</a>
  		</li>
    	<li class="@yield('active-memberalb')">
    		<a href="{{ url('common/member/alb')}}">Member Anggota Luar Biasa</a>
    	</li>
  	</ul>	
</li>