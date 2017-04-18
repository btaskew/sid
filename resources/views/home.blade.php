@extends('partials.master')
@section('content')


<div id="root">
  <h1>Notifications</h1>
  <hr>
  @foreach ($notifications as $id => $message)

  <notification>

    <div slot="header">
      {{$message['title']}}
    </div>

    <form slot="delete" action="notifications/{{$id}}/delete" method="post">
      {{csrf_field()}}
      <input type="submit" class="delete-notification" name="delete-notification" value="X">

    </form>

    {{$message['message']}}

    <a href="/calls/{{$message['call_id']}}/edit"><button type="button" class="btn btn-primary btn-notify-view">View call</button></a>

  </notification>

  @endforeach

</div>
<script src="/js/home.js"></script>
@endsection

@section('sidebar')
<form slot="delete" action="/notifications/delete" method="post">
  {{csrf_field()}}
  <input type="submit" class="btn btn-primary" name="delete-notification" value="Delete All Notifications">
</form>
@endsection
