@extends('partials.master')
@section('content')

@if($calls->isEmpty())
  <h1>You have no {{$category}} calls</h1><br>
  <a href="/calls/create"><button type="button" class="btn btn-primary">Create a call</button></a>
@else

  <h1>Current {{$category}} SID calls</h1>
  <hr>
  <div id="calls">
    @foreach ($calls as $call)

    @include('calls.show')

    @endforeach
  </div>

@endif
@endsection
