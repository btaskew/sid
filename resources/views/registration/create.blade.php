@extends('partials.master')
@section('content')
<div class="col-sm-8 blog-main">
  <h1>Register</h1>
  <hr />
  <form method="POST" action="/register" id="register">
    {{csrf_field()}}

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="form-group">
      <label for="password_confirmation">Re-type Password:</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="form-group">
      <label for="role">What is your role:</label>
      <div class="row">
        <div class="col-md-2">
          <input type="radio" class="form-control" name="role" value="student" required @click="studentChecked"> Student
        </div>
        <div class="col-md-2">
          <input type="radio" class="form-control" name="role" value="staff" required @click="staffChecked"> Staff
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="department">If staff, please enter your department:</label>
      <input type="test" class="form-control" id="department" name="department" :disabled="isDisabled" required>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="register">Register</button>
    </div>

    @include('partials.errors')

  </form>

  <script>
    new Vue({
      el: '#register',

      data: {
        isDisabled: true
      },

      methods: {
        staffChecked()
        {
          this.isDisabled = false;
        },
        studentChecked()
        {
          this.isDisabled = true;
        }
      },

    })
  </script>
</div>
@endsection
