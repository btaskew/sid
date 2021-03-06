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
            {{$call->description}}<br>
            <div style="font-style: italic; text-align: right">Call by: {{$call->caller()->name}}</div>
        </div>


          @foreach($actions as $action)
            <div class="request">

              @if($action->action_type === "Close Call")
                <div class="well closed-action">
              @elseif($action->user_id === currentUser()->id)
                <div class="well user-action">
              @else
                <div class="well">
              @endif

                  <h4>{{$action->action_type}} </h4>
                  {{$action->content}}
                  <div style="font-style: italic; text-align: right">
                    Actioned by: {{$action->actionedBy($action->user_id)}} - {{$action->created_at->format('j M Y, g:i a')}}
                  </div>
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
            <label for="action_type">Action Type:</label>
            <select class="form-control" name="action_type" required>
              @if($call->status === 1)
                <option value="5">Re-open
              @else
                <option value="1">Update
                @if(currentUser()->role_id === 1)
                <option value="2">Request for Information
                @else
                <option value="3">Answer Request
                @endif
                <option value="4">Close
              @endif
              </select>
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
