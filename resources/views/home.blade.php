@extends('partials.master')
@section('content')
<script src="/js/home.js"></script>

<h1>Notifications</h1>
<hr>
@foreach ($messages as $notificationId => $message)

<div class="row ">
  <div class="col-md-8">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">{{$message->title}}</h3>
        <form action="/{{$notificationId}}/delete" method="POST">
          {{csrf_field()}}
          <input type="submit" class="delete-notification" value="x"></input>
        </form>
      </div>

      <div class="panel-body">
        <p>
          {{$message->message}}
        </p>
      </div>
    </div>
  </div>
</div>

@endforeach

@endsection
