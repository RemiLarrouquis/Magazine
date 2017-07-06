@extends('layouts.home')

@section('content')

    <article class="content items-list-page liste-historique">
        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title">
                            Historiques client
                        </h3>
                        <p class="title-description">
                            <a href="{{ url('/historique/new') }}" class="btn btn-primary btn-sm rounded-s">
                                Nouvelle relation
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="items-search">
                <form class="form-inline" action="#" type="POST">
                    <div style="display: inline-flex;vertical-align: top !important;" >
                        <div class="action dropdown">
                            <button class="btn rounded-s btn-secondary dropdown-toggle" type="button" id="typeBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Type
                            </button>
                            <div class="dropdown-menu" aria-labelledby="typetBtn">
                                @foreach ($types as $type)
                                    <a class="dropdown-item" onclick="filterType({{ $type->id }}, '{{ $type->libelle }}');">
                                        {{ $type->libelle }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input id="search-nom" type="text" class="form-control boxed rounded-s" placeholder="Nom de l'employée">
                    </div>
                </form>
            </div>
        </div>

        <div id="list-view">
            @include('historique.list')

            <script src="{{ asset('js/historique.js') }}"></script>
        </div>

    </article>
@endsection


