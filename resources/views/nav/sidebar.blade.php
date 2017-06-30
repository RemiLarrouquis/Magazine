<div class="sidebar-header">
    <div class="brand">
        <!-- <div class="logo"></div> -->
        Publi'Magazine
    </div>
</div>
<nav class="menu">
    <ul class="nav metismenu" id="sidebar-menu">
        <li class="active">
            <a href="{{ url('/home') }}"> <i class="fa fa-home"></i> Publications </a>
        </li>

        <li>
            <a href=""> <i class="fa fa-users"></i> Clients <i class="fa arrow"></i> </a>
            <ul>
                <li>
                    <a href="{{ url('/client/list') }}">
                        Liste des clients
                    </a>
                </li>
                <li> <a href="{{ url('/abonnement/list') }}">
                        Abonnements
                    </a>
                </li>
            </ul>
        </li>

        <li class="active">
            <a href="{{ url('/historique/list') }}"> <i class="fa fa-list"></i> Historiques </a>
        </li>

        <!-- Hors scope
        <li>
            <a href="#"> <i class="fa fa-envelope"></i> Historiques des relations</a>
        </li>
        <li>
            <a href="#"> <i class="fa fa-bar-chart"></i> Statistiques </a>
        </li>
        -->

    </ul>
</nav>