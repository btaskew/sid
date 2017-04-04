@extends('partials.master')
@section('content')
<div class="row ">
  <div class="col-md-8">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">{{$call->title}}</h3>
        <h4 class="panel-title date-created">Call Made: {{$call->created_at->format('j M Y, g:i a')}}</h4>
      </div>

      <div class="panel-body">
        <div class="well original-call">
            <h4>Original call</h4>
            {{$call->description}}
        </div>


          @foreach($actions as $action)
          <div class="request">
            <div class="well">
              <h4>{{$action->type}} </h4>
              {{$action->content}}
            </div>
          </div>
          @endforeach


        <div class="panel-bottom">
          <p id="assigned_to">
            Assigned to: {{$call->assigned}}
          </p>
          <p id="priority">
            Priority: {{$call->priority}}
          </p>
        </div>

        <hr>
        <form action="/calls/{{$call->id}}/edit" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label for="type">Action Type:</label>
            <input type="text" class="form-control" id="type" name="type" required>
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
          </div>

          <hr>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </div>

        </form>

    </div>

    </div>
  </div>
</div>
@endsection
