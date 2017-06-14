<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" type="text/css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <!-- Styles -->
</head>
<body>
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="{{ url('/home') }}">Publi'Magazine</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if (Route::has('login'))

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li class="hidden">
                            <a href="{{ url('/home') }}"></a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{ url('/publication') }}">Publications</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{ url('/client') }}">Clients</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{ url('/historic') }}">Historiques</a>
                        </li>
                    @else
                        <li>
                            <a class="page-scroll" href="{{ url('/login') }}">Se connecter</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="{{ url('/register') }}">S'enregistrer</a>
                        </li>
                    @endif
                </ul>
            @endif

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Magazine
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Publication</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
</div>
</body>
</html>
