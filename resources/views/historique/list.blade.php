<div class="card items">
    <ul class="item-list striped">
        <!-- Début header list -->
        <li class="item item-list-header hidden-sm-down">

            <div class="item-row">
                <div class="item-col item-col-header item-col-title">
                    <div><span>Employé</span></div>
                </div>
                <div class="item-col item-col-header item-col-title clientToHide">
                    <div><span>Client</span></div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div><span>Type d'échange</span></div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div><span>Description</span></div>
                </div>
                <div class="item-col item-col-header item-col-stats">
                    <div class="no-overflow"><span>Date</span></div>
                </div>
                <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
            </div>
        </li>
        <!-- Fin header list -->
        <!-- Début liste dynamique -->
        @foreach ($histos as $histo)
            <li class="item">
                <div class="item-row">
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Employé</div>
                        <div>
                            {{$histo->employe_nom}}
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title clientToHide">
                        <div class="item-heading">Client</div>
                        <div>
                            {{$histo->client_nom}}  {{$histo->client_prenom}}
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Type d'échange</div>
                        <div>
                            {{$histo->type_libelle}}
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Description</div>
                        <div>
                            {{ str_limit($histo->description, $limit = 150, $end = '...') }}
                        </div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Date</div>
                        <div> {{ $histo->date }} </div>
                    </div>

                    <div class="item-col fixed item-col-actions-dropdown">
                        <div class="item-actions-dropdown">
                            <a class="edit"
                               href="{{ url('/historique/detail/') . '/' . $histo->id }}">
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
{{ $histos->links() }}