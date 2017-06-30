<div class="card items">
    <ul class="item-list striped">
        <!-- Début header list -->
        <li class="item item-list-header hidden-sm-down">

            <div class="item-row">
                <div class="item-col item-col-header item-col-title">
                    <div><span>Employé</span></div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div><span>Client</span></div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div><span>Type d'échange</span></div>
                </div>
                <div class="item-col item-col-header item-col-sales">
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
        @foreach ($clients as $client)
            <li class="item">
                <div class="item-row">
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Employé</div>
                        <div>
                            {{$client->employe_nom}}  {{$client->employe_prenom}}
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Client</div>
                        <div>
                            {{$client->client_nom}}  {{$client->client_prenom}}
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Type d'échange</div>
                        <div>
                            {{$client->type_libelle}}
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Description</div>
                        <div>
                            {{ str_limit($client->description, $limit = 150, $end = '...') }}
                        </div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Date</div>
                        <div> {{ $client->date }} </div>
                    </div>

                    <div class="item-col fixed item-col-actions-dropdown">
                        <div class="item-actions-dropdown">
                            <a class="edit"
                               href="{{ url('/client/detail/') . '/' . $client->id }}">
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
{{ $clients->links() }}