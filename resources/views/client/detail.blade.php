@extends('layouts.home')

@section('content')
    <style type="text/css">
        .item-list .item-col.fixed {
            flex-basis: 0;
        }
    </style>

    <article class="content dashboard-page liste-client details">
        <section class="section">
            <div class="row sameheight-container">
                <div class="col col-xs-12 col-sm-12 col-md-8 col-xl-8 stats-col">
                    <div class="card sameheight-item stats" data-exclude="xs" style="height: 323px;">
                        <div class="card-block" style="width: auto;">
                            <form id="editForm" action="{{ url('/client/edit') }}" method="POST" >
                                {{ csrf_field() }}
                                <input type="hidden" id="idClient" name="id" value="{{$client->id}}">
                                <div class="form-group row" style="margin-top: 16px;">
                                    <div class="col-sm-6" >
                                        <label for="sexe" class="col-sm-3 form-control-label">Civilité</label>
                                        <div class="col-sm-8">
                                            <select id="sexe" name="sexe_id" readonly="readonly" disabled="disabled"
                                                    class="form-control editable">
                                                @foreach($statuses as $status)
                                                    @if($status->id == $client->sexe_id)
                                                        <option value="{{$status->id}}" selected="selected">
                                                    @else
                                                        <option value="{{$status->id}}">
                                                    @endif
                                                        {{$status->libelle}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6" >
                                        <label for="nom" class="col-sm-3 form-control-label">Nom</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control editable" id="nom"
                                                   name="nom" value="{{$client->nom}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <label for="adresse" class="col-sm-3 form-control-label">Adresse</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control editable"
                                                   id="adresse" name="adresse" value="{{$client->adresse}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6" >
                                        <label for="prenom" class="col-sm-3 form-control-label">Prenom</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control editable"
                                                   id="prenom" name="prenom" value="{{$client->prenom}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <label for="code_postal" class="col-sm-3 form-control-label">Code postal</label>
                                        <div class="col-sm-8">
                                            <input type="number" readonly="readonly" class="form-control editable"
                                                   id="code_postal" name="code_postal" value="{{$client->code_postal}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6" >
                                        <label for="email" class="col-sm-3 form-control-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" readonly="readonly" disabled="disabled" class="form-control"
                                                   id="email" value="{{$client->email}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <label for="telephone" class="col-sm-3 form-control-label">Téléphone</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control editable"
                                                   id="telephone" name="telephone" value="{{$client->telephone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6" >
                                        <label for="date_naissance" class="col-sm-3 form-control-label">Date de naissance</label>
                                        <div class="col-sm-8">
                                            <input type="date" readonly="readonly" class="form-control editable"
                                                   id="date_naissance" name="date_naissance" value="{{$client->date_naissance}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <label for="lieu_naissance" class="col-sm-3 form-control-label">Lieu de naissance</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control editable"
                                                   id="lieu_naissance" name="lieu_naissance" value="{{$client->lieu_naissance}}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-12 col-md-4 col-xl-4 history-col">
                    <div class="card card-primary sameheight-item" data-exclude="xs" style="height: 323px;">
                        <div class="card-header card-header-sm bordered">
                            <div class="header-block">
                                <p class="title text-white"> Actions </p>
                            </div>
                        </div>
                        <div class="card-block" style="width: auto;">
                            <a type="button" id="editClient" onclick="editFormClient()" class="btn btn-secondary btn-lg btn-block">
                                Modifier le client
                            </a>
                            <a type="button" class="btn btn-secondary btn-lg btn-block"
                               href="{{ url('/abonnement/list')."?client_id=".$client->id }}">
                                Voir tous ces abonnements
                            </a>
                            <hr>
                            <a type="button" class="btn btn-secondary btn-lg btn-block"
                               href="{{ url('/historique/new')."?client_id=".$client->id }}">
                                Créer un échange
                            </a>
                            <a type="button" class="btn btn-secondary btn-lg btn-block"
                               href="{{ url('/historique/list')."?client_id=".$client->id }}">
                                Voir l'historique de ces échanges
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row sameheight-container">
                <div class="col-xl-6">
                    <div class="card sameheight-item items" data-exclude="xs,sm,lg" style="height: 400px;">
                        <div id="listEchanges" class="card-header bordered">
                            <div class="header-block">
                                <h3 class="title"> Dernières relations </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card sameheight-item sales-breakdown" data-exclude="xs,sm,lg" style="height: 400px;">
                        <div id="listAbonnement" class="card-header bordered">
                            <div class="header-block">
                                <h3 class="title"> Derniers Abonnements </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>

    <script src="{{ asset('js/clients.js') }}"></script>
@endsection