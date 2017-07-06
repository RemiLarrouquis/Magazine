<div class="sidebar-header">
    <div class="brand">
        <!-- <div class="logo"></div> -->
        Publi'Magazine
    </div>
</div>
<nav class="menu">
    <ul class="nav metismenu" id="sidebar-menu">
        <li>
            <a href="">
                <i class="fa fa-home"></i> Publication <i class="fa arrow"></i>
            </a>
            <ul>
                <li>
                    <a id="liste-publication" href="{{ url('/publication/list') }}">
                        Liste
                    </a>
                </li>
                <li>
                    <a id="fiche-publication" href="{{ url('/publication/new') }}">
                        Nouvelle
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a id="liste-client" href="{{ url('/client/list') }}">
                <i class="fa fa-users"></i> Clients
            </a>
        </li>
        <li>
            <a href="">
                <i class="fa fa-share-alt"></i> Abonnements <i class="fa arrow"></i>
            </a>
            <ul>
                <li>
                    <a id="liste-abonnement" href="{{ url('/abonnement/list') }}">
                        Tous
                    </a>
                </li>
                <li>
                    <a id="liste-abonnement-impaye" href="{{ url('/abonnement/list?full=true&filterPaye=8&filterEnCours=false') }}">
                        Impayées
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a id="liste-historique" href="{{ url('/historique/list') }}">
                <i class="fa fa-list"></i> Historiques </a>
        </li>

        <!-- Hors scope
        <li>
            <a href="#"> <i class="fa fa-bar-chart"></i> Statistiques </a>
        </li>
        -->

    </ul>
</nav>