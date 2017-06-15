<nav class="navbar navbar-inverse bg-inverse navbar-toggleable-md sticky-top navbar-light bg-faded">
    <div class="container">
        <div class="navbar-header">

            <!-- Branding Image -->
            <a class="navbar-brand page-scroll" href="{{ url('/home') }}">Publi'Magazine</a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if (!Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ url('/publication') }}">Publications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ url('/client') }}">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ url('/story') }}">Historiques</a>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="nav-item dropdown show">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Se déconnecter
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>