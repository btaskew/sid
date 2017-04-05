<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    @if(auth()->check())
    <li><a href="/calls/create">Create a call</a></li>
    <li><a href="/calls/active-calls">My active calls</a></li>
    <li><a href="/calls/closed-calls">My closed calls</a></li>
    @endif
  </ul>
  <ul class="nav nav-sidebar">
    <!-- Seperate items to go here -->
  </ul>
</div>
