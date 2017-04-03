<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/dashboard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://unpkg.com/vue@2.2.6"></script>
    <title>SID</title>
  </head>
  <body>

    @include('partials/top-nav')
    <div class="container-fluid">
      <div class="row">
        @include('partials/side-nav')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          @if ($flash = session('message'))
          <div class="alert alert-success" role="alert">
            {{$flash}}
          </div>
          @endif
          @yield('content')
        </div>
      </div>

    </div>

  </body>
</html>
