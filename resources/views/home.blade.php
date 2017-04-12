@extends('partials.master')
@section('content')


<div id="root">
  <h1>Notifications</h1>
  <hr>
  @foreach ($notifications as $id => $message)

  <notification>

    <div slot="header">
      {{$message->title}}
    </div>

    <div slot="delete">
      <form action="/{{$id}}/delete" method="POST">
        {{csrf_field()}}
        <input type="submit" class="delete-notification" value="x"></input>
      </form>
    </div>

    {{$message->message}}

  </notification>

  @endforeach

</div>
<script src="/js/home.js"></script>
@endsection
