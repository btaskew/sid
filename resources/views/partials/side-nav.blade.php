<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    @if(auth()->check())
    <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
    <li><a href="#">Create a call</a></li>
    <li><a href="#">My active calls</a></li>
    <li><a href="#">My closed calls</a></li>
    @endif
  </ul>
  <ul class="nav nav-sidebar">
    <!-- Seperate items to go here -->
  </ul>
</div>
