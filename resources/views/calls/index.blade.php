@extends('partials.master')
@section('content')
  <h1>Current active SID calls</h1>
  <hr>

  <div id="calls">
    @foreach ($calls as $call)

    @include('calls.show')

    @endforeach
  </div>

@endsection
