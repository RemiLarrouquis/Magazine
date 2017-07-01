@extends('layouts.home')

@section('content')
    <article class="content cards-page liste-client">
        <div class="title-block">
            <h3 class="title"> Fiche client </h3>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card card-default">
                        <div class="card-block" style="width: auto;">
                            <form>
                                <!-- Row -->
                                <div class="form-group row" style="margin-top: 16px;">
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="sexe" class="col-sm-3 form-control-label">Civilité</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="sexe" value="{{$client->libelle}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Row -->
                                <div class="form-group row">
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="nom" class="col-sm-3 form-control-label">Nom</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="nom" value="{{$client->nom}}">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="adresse" class="col-sm-3 form-control-label">Adresse</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="adresse" value="{{$client->adresse}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Row -->
                                <div class="form-group row">
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="prenom" class="col-sm-3 form-control-label">Prenom</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="prenom" value="{{$client->prenom}}">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="code_postal" class="col-sm-3 form-control-label">Code postal</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="code_postal" value="{{$client->code_postal}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Row -->
                                <div class="form-group row">
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="email" class="col-sm-3 form-control-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="email" value="{{$client->email}}">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="telephone" class="col-sm-3 form-control-label">Téléphone</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="telephone" value="{{$client->telephone}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Row -->
                                <div class="form-group row">
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="date_naissance" class="col-sm-3 form-control-label">Date de naissance</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="date_naissance" value="{{$client->date_naissance}}">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-6" >
                                        <label for="lieu_naissance" class="col-sm-3 form-control-label">Lieu de naissance</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly="readonly" class="form-control" id="lieu_naissance" value="{{$client->lieu_naissance}}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-xl-4 -->
                <div class="col-xl-4">
                    <div class="card card-primary" style="height: 313px;">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title text-white"> Actions </p>
                            </div>
                        </div>
                        <div class="card-block" style="width: auto;">
                            <a type="button" class="btn btn-secondary btn-lg btn-block">Voir tous ces abonnements</a>
                            <a type="button" class="btn btn-secondary btn-lg btn-block" href="{{ url('/historique/detail/') . '/' . $client->id }}">Voir l'historique des relations</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title"> Historique des relations </p>
                            </div>
                        </div>
                        <div class="card-block">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                        </div>
                    </div>
                </div>
                <!-- /.col-xl-4 -->
                <div class="col-xl-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="header-block">
                                <p class="title"> Abonnements récents </p>
                            </div>
                        </div>
                        <div class="card-block">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
    </article>
@endsection