
<div class="card items">
    <ul class="item-list striped">
        <!-- Début header list -->
        <li class="item item-list-header hidden-sm-down">
            <div class="item-row">
                <div class="item-col item-col-header item-col-title">
                    <div> <span>Nom</span> </div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div> <span>Adresse mail</span> </div>
                </div>
                <div class="item-col item-col-header item-col-title">
                    <div> <span>Adresse</span> </div>
                </div>
                <div class="item-col item-col-header item-col-stats">
                    <div class="no-overflow"><span>Code postal</span> </div>
                </div>
                <div class="item-col item-col-header item-col-stats">
                    <div class="no-overflow"> <span>Téléphone</span> </div>
                </div>
                <div class="item-col item-col-header item-col-stats">
                    <div class="no-overflow"> <span>Email confirmé</span> </div>
                </div>
                <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
            </div>
        </li>
        <!-- Fin header list -->
        <!-- Début liste dynamique -->
        @foreach ($clients as $client)
            <li class="item">
                <div class="item-row">
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Nom</div>
                        <div>
                            <h4 class="item-title"> {{ $client->nom.' '.$client->prenom}} </h4>
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Adresse mail</div>
                        <div>
                            <h4 class="item-title">
                                {{ $client->email }}
                            </h4>
                        </div>
                    </div>
                    <div class="item-col fixed pull-left item-col-title">
                        <div class="item-heading">Adresse</div>
                        <div>
                            <h4 class="item-title">
                                {{ $client->adresse }}
                            </h4>
                        </div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Code postal</div>
                        <div> {{ $client->code_postal }} </div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Téléphone</div>
                        <div> {{ $client->telephone }} </div>
                    </div>
                    <div class="item-col item-col-stats no-overflow">
                        <div class="item-heading">Email confirmé</div>
                        @if($client->mail_confirm)
                            <div> <i class="fa fa-check-circle-o"></i> </div>
                        @else
                            <div> <i class="fa fa-circle-o"></i> </div>
                        @endif

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