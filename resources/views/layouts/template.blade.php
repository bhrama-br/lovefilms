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
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-K7DC3BL');</script>
  <!-- End Google Tag Manager -->
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K7DC3BL"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
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


  <footer>
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            Used TMDb API.
          </div>
        </div>
      </div>
    </div>
  </footer>
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