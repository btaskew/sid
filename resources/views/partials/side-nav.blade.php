<div class="col-sm-3 col-md-2 sidebar">
  @if(auth()->check())
  <ul class="nav nav-sidebar">
      <li><a href="/calls/create">Create a call</a></li>
      <li><a href="/calls/active">My active calls</a></li>
      <li><a href="/calls/closed">My closed calls</a></li>
  </ul>
  <ul class="nav nav-sidebar">
  @if(currentUser()->role_id === 1)
    <li><a href="/calls/assigned">My assigned calls</a></li>
    <li><a href="/calls/closedAssigned">My closed assigned calls</a></li>
    @endif
  </ul>
  @endif
  @yield('sidebar')
</div>
