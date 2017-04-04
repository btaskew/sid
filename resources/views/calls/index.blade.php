@extends('partials.master')
@section('content')

@if($calls->isEmpty())
  <h1>You have no active calls</h1><br>
  <a href="/calls/create"><button type="button" class="btn btn-primary">Create a call</button></a>
@else

  <h1>Current active SID calls</h1>
  <hr>
  <div id="calls">
    @foreach ($calls as $call)

    @include('calls.show')

    @endforeach
  </div>

@endif
@endsection
