@extends('partials.master')
@section('content')

<div id="root">
@if($calls->isEmpty())
  <h1>You have no {{$category}} calls</h1><br>
  @if($category == "active" || $category == "closed")
    <a href="/calls/create"><button type="button" class="btn btn-primary">Create a call</button></a>
  @endif
@else

  <h1>Current {{$category}} SID calls</h1>
  <hr>
  <div id="calls">
    @foreach ($calls as $call)

      <call>

        <div slot="title">{{$call->title}}</div>

        @if($call->priority === "Urgent")
            <div slot="urgent">URGENT</div>
        @endif

        <div slot="call-made">{{$call->created_at->format('j M Y, g:i a')}}</div>

        <div slot="body">{{$call->description}}</div>

        <div slot="actions">
          @if(array_key_exists($call->id, $actions) && $call->first_response == 1)
            <div class="request">
                <h4 class="has-actions">{{$actions[$call->id]}} Action/s</h4>
            </div>
          @else
            <h4>Awaiting first response</h4>
          @endif
        </div>

        <a slot="button" href="/calls/{{$call->id}}/edit"><button type="button" class="btn btn-primary">View/Edit call</button></a>

      </call>

    @endforeach
  </div>

@endif
</div>
<script src="/js/call.js"></script>
@endsection
