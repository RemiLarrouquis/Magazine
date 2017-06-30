@extends('layouts.home')

@section('content')

    <article class="content items-list-page">
        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title">
                            Liste des abonnements
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="items-search">
                <form class="form-inline" action="#" type="POST">
                    <div style="display: inline-flex;vertical-align: top !important;" >
                        <div class="action dropdown">
                            <button class="btn rounded-s btn-secondary dropdown-toggle" type="button" id="etatBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Etat
                            </button>
                            <div class="dropdown-menu" aria-labelledby="etatBtn">
                                @foreach ($etats as $etat)
                                    <a class="dropdown-item" onclick="filterEtat({{ $etat->id }}, '{{ $etat->libelle }}');">
                                        {{ $etat->libelle }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="action dropdown">
                            <button class="btn rounded-s btn-secondary dropdown-toggle" type="button" id="statusBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="statusBtn">
                                @foreach ($statuses as $status)
                                    <a class="dropdown-item" onclick="filterStatus({{ $status->id }}, '{{ $status->libelle }}')">
                                        {{ $status->libelle }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="buttonDateFin" class="btn btn-secondary rounded-s" type="button">
                                Date de fin <i class="fa fa-sort"></i>
                            </button>
                        </span>
                        <input id="search-titre" type="text" class="form-control boxed rounded-s" placeholder="Titre publication contient...">
                    </div>
                </form>
            </div>
        </div>


        <div id="list-view">
            @include('abonnement.list')

            <script src="{{ asset('js/abonnements.js') }}"></script>
        </div>

    </article>

@endsection


