<div class="row ">
  <div class="col-md-8">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">{{$call->title}}</h3>
        <h4 class="panel-title date-created">Call Made: {{$call->created_at->format('j M Y, g:i a')}}</h4>
      </div>
      <div class="panel-body">
        <p>
          {{$call->description}}
        </p>

        @if($call->response)
        <div class="request">
          <div class="well">
            <h4>Request for more information: </h4>
            {{$call->response}}
          </div>
        </div>
        @endif

        <hr>
        <div class="panel-bottom">
          <p id="assigned_to">
            Assigned to: {{$call->assigned_to}}
          </p>
          <p id="priority">
            Priority: {{$call->level}}
          </p>
          <a href="/calls/{{$call->id}}/edit"><button type="button" class="btn btn-primary">Edit call</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
