<div class="col-sm-3 col-md-2 sidebar">
  @if(auth()->check())
  <ul class="nav nav-sidebar">
      <li><a href="/calls/create">Create a call</a></li>
      <li><a href="/calls/active-calls">My active calls</a></li>
      <li><a href="/calls/closed-calls">My closed calls</a></li>
  </ul>
  <ul class="nav nav-sidebar">
  @if(currentUser()->role_id === 1)
    <li><a href="/calls/assigned-calls">My assigned calls</a></li>
    <li><a href="/calls/closed-assigned-calls">My closed assigned calls</a></li>
    @endif
  </ul>
  @endif
</div>
