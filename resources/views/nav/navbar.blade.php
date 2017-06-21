<ul class="nav-profile">
    <li class="profile dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user icon"></i>
            <span class="name">{{ Auth::user()->nom }}</span>
        </a>
        <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
            <!-- <a class="dropdown-item" href="#"> <i class="fa fa-user icon"></i> Profile </a> -->
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off icon"></i> Se déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
</ul>