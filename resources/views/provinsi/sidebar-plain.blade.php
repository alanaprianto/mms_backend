<li><a href="{{ url('dashboard/provinsi') }}"><i class="fa fa-dashboard"></i><span class="nav-label">Dashboard</span></a></li>
<li>
  <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">KTA</span><span class="fa arrow"></span></a>
  <ul class="nav nav-second-level">
  	<li><a href="{{ url('dashboard/provinsi/kta/list') }}">List KTA</a></li>
    <li><a href="{{ url('dashboard/provinsi/kta/request') }}">KTA Request</a></li>
    <li><a href="{{ url('dashboard/provinsi/kta/cancel') }}">Canceled KTA Request</a></li>    
  </ul>
</li>
<li><a href="{{ url('dashboard/provinsi/valnas') }}"><i class="fa fa-list-alt"></i><span class="nav-label">Validasi Nasional</span></a></li>