<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Bootstrap Core CSS -->
  <link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="{{ URL::asset('/css/clean-blog.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('/css/custom.css') }}" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- jQuery -->
  <script src="{{ URL::asset('/js/jquery.js') }}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>

  <!-- Custom JavaScript -->
  <script src="{{ URL::asset('/js/clean-blog.min.js') }}"></script>
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

  <style>
  body {
    font-family: 'Lato';
  }

  .fa-btn {
    margin-right: 6px;
  }
  </style>

  @yield('scripts')

  <script>
  // Las siguientes dos líenas se encargan de que en los formularios donde el usuario haga click, se cambie el color del input
  $(document).on("focus", ".maskhos-z-input", function(){$(this).parents(".maskhos-pro-div").addClass("maskhos-input-focused")});
  $(document).on("blur", ".maskhos-z-input", function(){$(this).parents(".maskhos-pro-div").removeClass("maskhos-input-focused")});
  </script>
</head>
<body id="app-layout">
  <nav id="menu" class="navbar navbar-default navbar-custom navbar-fixed-top maskhos-navbar">
    <div class="container-fluid">
      <div class="navbar-header page-scroll">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
          Fábulas de Maskhos
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/gameplay') }}">Mecanicas</a></li>
          <li><a href="{{ url('/story') }}">Historia</a></li>
          <li><a href="{{ url('/characters') }}">Personajes</a></li>
          <li class="maskhos-blog"><a href="{{ url('/blog') }}">Blog</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->usname }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/detailuser') }}"><i class="fa fa-pencil fa-sign-out"></i>Detail User</a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>



          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer>
    <div class="container maskhos-top-buffer">
      <div class="row maskhos-footer">
        <div class="col-lg-3 col-md-2 col-xs-12 maskhos-mini-buffer">
          <ul class="list-inline text-left">
            <li>
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-12 maskhos-mini-buffer">
          <img class="img-responsive" src="/proyecto/public/img/pp-logo.png"/>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-12 maskhos-mini-buffer">
          <img class="img-responsive" src="/proyecto/public/img/logo.png"/>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-12 maskhos-mini-buffer">
          <img class="img-responsive" src="/proyecto/public/img/license.png"/>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>
