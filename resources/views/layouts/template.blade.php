<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('logo.png') }}" alt="Love Films" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('index') }}">Movies</a>
            </li>
            
          </ul>
          <form id="search" class="form-inline my-2 my-md-0">
            <input class="form-control value" type="text" placeholder="Search" aria-label="Search">
          </form>
        </div>
      </div>
    </nav>
  </header>
  @yield('content')

  <!-- Scripts -->
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script>
    $("#search").submit(function(){
      var search = $(".value").val();

      window.location.replace('/search/'+search);

      return false;
    })
  </script>
</body>
</html>