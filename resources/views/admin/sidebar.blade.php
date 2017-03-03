<li class="@yield('active-dashboard')">
  <a href="{{ url('admin/dashboard')}}">
    <i class="fa fa-dashboard"></i>
    <span class="nav-label">Dashboard</span>
  </a>
</li>
<li class="@yield('active-dform')">
    <a href="#">
      <i class="fa fa-table"></i> 
      <span class="nav-label">Dynamic Forms</span>
      <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level" aria-expanded="true">
      <li class="@yield('active-dform-setting')"><a href="{{ url('admin/setting')}}">Form Setting</a></li>
      <li class="@yield('active-dform-types')"><a href="{{ url('admin/types')}}">Form Type</a></li>
      <li class="@yield('active-dform-rules')"><a href="{{ url('admin/rules')}}">Form Rules</a></li>
      <li class="@yield('active-dform-question')"><a href="{{ url('admin/question')}}">Form Question</a></li>
      <li class="@yield('active-dform-qgroup')"><a href="{{ url('admin/question_group')}}">Form Question Group</a></li>
      <li class="@yield('active-dform-answer')"><a href="{{ url('admin/answer')}}">Form Answer</a></li>
      <li class="@yield('active-dform-result')"><a href="{{ url('admin/result')}}">Form Result</a></li>
  </ul>
</li>
<li class="@yield('active-user')">
  <a href="{{ url('admin/user')}}">
    <i class="fa fa-user"></i>
    <span class="nav-label">Users</span>
  </a>
</li>
<li class="@yield('active-member')">
  <a href="{{ url('admin/member')}}">
    <i class="fa fa-users"></i>
    <span class="nav-label">Members</span>
  </a>
</li>
<li class="@yield('active-organizer')">
  <a href="{{ url('admin/organizer')}}">
    <i class="fa fa-sitemap"></i>
    <span class="nav-label">Organizers</span>
    <span class="fa arrow"></span>
  </a>
  <ul class="nav nav-second-level" aria-expanded="true">
    <li class="@yield('active-organizer-setting')"><a href="{{ url('admin/organizer/setting_')}}">Setting</a></li>
    <li class="@yield('active-organizer-list')"><a href="{{ url('admin/organizer/list')}}">List</a></li>
  </ul>
</li>
<li class="@yield('active-market')">
  <a href="#">
    <i class="fa fa-shopping-cart"></i>
    <span class="nav-label">Marketplace</span>
    <span class="fa arrow"></span>
  </a>
  <ul class="nav nav-second-level" aria-expanded="true">
      <li class="@yield('active-market-category')"><a href="{{ url('admin/marketplace/category')}}">Category</a></li>
      <li class="@yield('active-market-slider')"><a href="{{ url('admin/marketplace/slider')}}">Slider</a></li>
    <li class="@yield('active-market-frontend')"><a href="">Frontend</a></li>
  </ul>
</li>