@extends('layouts.home')

@section('content')

    <article class="content items-list-page">
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
                    <div class="input-group">
                        <input id="search-nom" type="text" class="form-control boxed rounded-s" placeholder="Client">
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


