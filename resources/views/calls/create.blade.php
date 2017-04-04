@extends('partials.master')
@section('content')

<h1>Create a new SID call</h1>
<hr>

<div class="col-md-6">
  <form method="POST" action="/calls">
      {{csrf_field()}}

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
      </div>

      <div class="form-group">
        <label for="priority">Priority</label>
        <select class="form-control" id="priority" name="priority" required>
          <option value=0>
            Normal
          </option>
          <option value=1>
            Urgent
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="staff_id">Assign To</label>
        <select class="form-control" id="staff_id" name="staff_id" required>
          @foreach($staff as $person)
            <option value="{{$person->id}}">
              {{$person->name}} - {{$person->department}}
            </option>
          @endforeach
        </select>
      </div>
      <hr>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="publish">Publish</button>
      </div>

      @include('partials.errors')

    </form>
</div>


@endsection
