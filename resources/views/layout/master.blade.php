<html>
  <head>
    <meta charset="utf-8">
    <title>LTTng Web View</title>

    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/sb-admin.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}">

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/loader.js') }}"></script>
    <script src="{{ URL::asset('js/app.js') }}"></script>
  </head>

  <body>
    <div id="wrapper">
      <!-- Navigation -->
      @include('shared.navigation')
      <div id="page-wrapper">
          <div class="container-fluid">
            @section('content')
            @show
          </div>
          <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
    </div>
  </body>
</html>
