@extends('layouts.home')

@section('content')

    <article class="content items-list-page">
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
        </div>
        <div class="card items">
            <ul class="item-list striped">
                <!-- Début header list -->
                <li class="item item-list-header hidden-sm-down">
                    <div class="item-row">
                        <div class="item-col item-col-header fixed item-col-img md">
                            <div> <span>Image</span> </div>
                        </div>
                        <div class="item-col item-col-header item-col-title">
                            <div> <span>Titre</span> </div>
                        </div>
                        <div class="item-col item-col-header item-col-title">
                            <div> <span>Description</span> </div>
                        </div>
                        <div class="item-col item-col-header item-col-sales">
                            <div> <span>Prix par an</span> </div>
                        </div>
                        <div class="item-col item-col-header item-col-stats">
                            <div class="no-overflow"> <span>Nombre par an</span> </div>
                        </div>
                        <div class="item-col item-col-header fixed item-col-actions-dropdown"> </div>
                    </div>
                </li>
                <!-- Fin header list -->
                <!-- Début liste dynamique -->
                @foreach ($publications as $publication)
                    <li class="item">
                        <div class="item-row">
                            <div class="item-col fixed item-col-img md">
                                <div class="item-img rounded" style="background-image: url({{url('uploads/'.$publication->fichier->nom_server)}})"></div>
                            </div>
                            <div class="item-col fixed pull-left item-col-title">
                                <div class="item-heading">Titre</div>
                                <div>
                                    <h4 class="item-title"> {{ $publication->titre }} </h4>
                                </div>
                            </div>
                            <div class="item-col fixed pull-left item-col-title">
                                <div class="item-heading">Description</div>
                                <div>
                                    <h4 class="item-title">
                                        {{ str_limit($publication->description, $limit = 150, $end = '...') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="item-col item-col-sales">
                                <div class="item-heading">Prix par an</div>
                                <div> {{ $publication->prix_an }} <i class="fa fa-eur"></i></div>
                            </div>
                            <div class="item-col item-col-stats no-overflow">
                                <div class="item-heading">Nombre par an</div>
                                <div> {{ $publication->nb_an }} </div>
                            </div>
                            <div class="item-col fixed item-col-actions-dropdown">
                                <div class="item-actions-dropdown">
                                    <a class="edit"
                                       href="{{ url('/publication/edit/') . '/' . $publication->id }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    <!-- Fin liste dynamique -->
            </ul>
        </div>
        <nav class="text-xs-right">
            <ul class="pagination">
                <li class="page-item"> <a class="page-link" href="">
                        Prev
                    </a> </li>
                <li class="page-item active"> <a class="page-link" href="">
                        1
                    </a> </li>
                <li class="page-item"> <a class="page-link" href="">
                        2
                    </a> </li>
                <li class="page-item"> <a class="page-link" href="">
                        3
                    </a> </li>
                <li class="page-item"> <a class="page-link" href="">
                        4
                    </a> </li>
                <li class="page-item"> <a class="page-link" href="">
                        5
                    </a> </li>
                <li class="page-item"> <a class="page-link" href="">
                        Next
                    </a> </li>
            </ul>
        </nav>
    </article>



@endsection


