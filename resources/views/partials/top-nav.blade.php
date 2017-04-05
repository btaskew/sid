<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">SID</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
          <li><a class="nav-link ml-auto" href="#">{{ucfirst(currentUser()->name)}}</a></li>
          <li><a class="nav-link" href="/logout">Logout</a></li>
        @else
          <li><a class="nav-link ml-auto" href="/login">Login</a></li>
          <li><a class="nav-link" href="/register">Register</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
