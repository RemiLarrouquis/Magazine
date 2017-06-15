<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Magazine') }}</title>

    <!-- Bootstrap Styles -->
    <link href="{{ asset('css/vendor.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/app-purple.css') }}" type="text/css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">

</head>
<body>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <div class="main-wrapper">
        <div class="app" id="app">
            <header class="header">
                <div class="header-block header-block-nav">
                    @include('nav.navbar')
                </div>
            </header>
            <aside class="sidebar">
                <div class="sidebar-container">
                    @include('nav.sidebar')
                </div>
            </aside>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <article class="content dashboard-page">
                <section class="section">
                    <div class="row sameheight-container">
                        @yield('content')
                    </div>
                </section>
            </article>
            <footer class="footer">
                <div class="footer-block buttons">
                    <iframe class="footer-github-btn"
                                src="https://ghbtns.com/github-btn.html?user=RemiLarrouquis&repo=magazine&type=star&count=true"
                            frameborder="0" scrolling="0" width="140px" height="20px"></iframe>
                </div>
                <div class="footer-block author">
                    <ul>
                        <li> Créé par Rémi Larrouquis </li>
                        <li> Ludovic Girard </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
</body>

</html>
