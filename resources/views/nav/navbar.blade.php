<nav class="navbar navbar-inverse bg-inverse navbar-toggleable-md sticky-top navbar-light bg-faded">
    <div class="navbar-header">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/home') }}" style="margin-left: 30px;">Publi'Magazine</a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <!-- Used to push right side -->
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav navbar-right">
            <!-- Authentication Links -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown02"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right:20px;">
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
        </ul>
    </div>
</nav>