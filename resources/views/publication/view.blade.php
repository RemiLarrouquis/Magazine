@extends('layouts.home')

@section('content')

    <article class="content items-list-page liste-publication">
        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title">
                            Liste des publications
                        </h3>
                        <p class="title-description">
                            <a href="{{ url('/publication/new') }}" class="btn btn-primary btn-sm rounded-s">
                                Nouvelle publication
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="items-search">
                <form class="form-inline" action="#" type="POST">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="buttonPrixSort" class="btn btn-secondary rounded-s" type="button">
                                Par prix <i class="fa fa-sort"></i>
                            </button>
                        </span>
                        <input id="search-titre" type="text" class="form-control boxed rounded-s" placeholder="Titre contient...">
                    </div>
                </form>
            </div>
        </div>


        <div id="list-view">
            @include('publication.list')

            <script src="{{ asset('js/publications.js') }}"></script>
        </div>

    </article>

@endsection


