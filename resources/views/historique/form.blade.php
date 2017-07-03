@extends('layouts.home')

@section('content')
    <article class="content dashboard-page">
        <div class="title-block">
            <h3 class="title"> Historiques </h3>
            <p class="title-description"> {{ $sub_title }} </p>
        </div>
        <section class="section">
            <div class="row sameheight-container">
                <div class="row">
                    <div @if($historique->id != null) class="col-md-10" @else class="col-lg-12" @endif>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ url('/historique/save') }}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">

                                        <div class="col-xs-12">
                                            <div class="row form-group{{ $errors->has('titre') ? ' has-error' : '' }}">
                                                <label for="titre" class="col-md-4 control-label">Choisir un
                                                    client</label>

                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <select class="form-control" type="client_id">
                                                        @foreach ($clients as $client)
                                                            <option value="{{$client->id}}">{{$client->nom}} {{$client->prenom}}</option>
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('titre'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('titre') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <div class="col-xs-12">
                                            <div class="row form-group{{ $errors->has('titre') ? ' has-error' : '' }}">
                                                <label for="titre" class="col-md-4 control-label">Type de
                                                    relation</label>

                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <select class="form-control" name="type_id">
                                                        @foreach ($statuses as $status)
                                                            <option value="{{$status->id}}">{{$status->libelle}}</option>
                                                        @endforeach
                                                    </select>


                                                @if ($errors->has('titre'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('titre') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description"
                                               class="col-md-4 control-label">Description</label>

                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                    <textarea id="description" rows="4" cols="50" class="form-control"
                                              name="description" required>{{$historique->description}}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
