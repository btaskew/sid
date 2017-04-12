//Redundant

//To use instead of vue add "include('calls.show')"


<div class="row ">
  <div class="col-md-8">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">{{$call->title}}</h3>
        @if($call->priority === "Urgent")
          <h3 class="panel-title">URGENT</h3>
        @endif
        <h4 class="panel-title date-created">Call Made: {{$call->created_at->format('j M Y, g:i a')}}</h4>
      </div>

      <div class="panel-body">
        <p>
          {{$call->description}}
        </p>

        <div class="panel-bottom">
          @if(array_key_exists($call->id, $actions))
            <div class="request">
                <h4 class="has-actions">{{count($actions[$call->id])}} Action/s</h4>
            </div>
            @else
            <h4>Awaiting first response</h4>
          @endif


          <a href="/calls/{{$call->id}}/edit"><button type="button" class="btn btn-primary">View/Edit call</button></a>
        </div>
      </div>

    </div>
  </div>
</div>
