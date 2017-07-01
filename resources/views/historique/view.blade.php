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
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="items-search">
                <form class="form-inline" action="#" type="POST">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="buttonConfirmMailSort" class="btn btn-secondary rounded-s" type="button">
                                Confirmés <i class="fa fa-sort"></i>
                            </button>
                        </span>
                        <input id="search-nom" type="text" class="form-control boxed rounded-s" placeholder="Nom contient...">
                    </div>
                </form>
            </div>
        </div>


        <div id="list-view">
            @include('historique.list')

            <script src="{{ asset('js/clients.js') }}"></script>
        </div>

    </article>

@endsection


