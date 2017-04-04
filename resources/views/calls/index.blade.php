@extends('partials.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h1>Current active SID calls</h1>
<hr>

@foreach ($calls as $call)

<div class="row ">
  <div class="col-md-8">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">{{$call->title}}</h3>
        <h4 class="panel-title date-created">{{$call->created_at->format('j M Y, g:i a')}}</h4>
      </div>
      <div class="panel-body">
        <p>
          {{$call->description}}
        </p>
        <hr>
        <div class="panel-bottom">
          <p>
            Assigned to: {{$call->assigned_to}}
          </p>
          <p>
            Priority: {{$call->level}}
          </p>
          <a href="/calls/{id}/edit"><button type="button" class="btn btn-primary">Edit call</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
@endforeach

</div>
