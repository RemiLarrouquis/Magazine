
<div class="card items">
    <ul class="item-list striped">
        <!-- Début header list -->
        <li class="item item-list-header hidden-sm-down">
            <div class="item-row">
                <div class="item-col item-col-header item-col-title">
                    <div> <span>Titre de la publication</span> </div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div> <span>Nom du client</span> </div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div> <span>Date de fin</span> </div>
                </div>
                <div class="item-col item-col-header item-col-stats">
                    <div class="no-overflow"><span>Etat</span> </div>
                </div>
                <div class="item-col item-col-header item-col-stats">
                    <div class="no-overflow"> <span>Status</span> </div>
                </div>
                <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
            </div>
        </li>
        <!-- Fin header list -->
        <!-- Début liste dynamique -->
        @foreach ($abos as $abo)
            <li class="item">
                <div class="item-row">
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Titre de la publication</div>
                        <div>
                            <h4 class="item-title"> {{$abo->titre}}  </h4>
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Nom du client</div>
                        <div>
                            <h4 class="item-title">
                                {{$abo->sexe_libelle}} {{$abo->nom}} {{$abo->prenom}}
                            </h4>
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Date de fin</div>
                        <div>
                            <h4 class="item-title">
                                {{$abo->date_fin}}
                            </h4>
                        </div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Etat</div>
                        <div>  {{$abo->etat_libelle}} </div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Status</div>
                        <div>  {{$abo->paye_libelle}} </div>
                    </div>
                    <div class="item-col fixed item-col-actions-dropdown">
                        <div class="item-actions-dropdown">
                            <a class="edit"
                               href="#">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            <!-- Fin liste dynamique -->
    </ul>
</div>
{{-- Pagination de la page (surcharge dans ressources/vendor/pagination/default.blade.php --}}
{{ $abos->links() }}