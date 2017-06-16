@extends('layouts.home')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ajout d'une publication</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/publication/save') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input id="id" type="text" class="form-control" name="id" hidden="true"
                               value="{{$publication->id}}">
                        <div class="row form-group{{ $errors->has('titre') ? ' has-error' : '' }}">
                            <label for="titre" class="col-md-4 control-label">Titre</label>

                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <input id="titre" type="text" class="form-control" name="titre"
                                       value="{{$publication->titre}}" required autofocus>

                                @if ($errors->has('titre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <label for="nban" class="col-md-12 control-label">Nombre par an</label>
                                <input id="nban" type="number" class="form-control" name="nban"
                                       value="{{$publication->nb_an}}" required>

                                @if ($errors->has('nb_an'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nb_an') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <label for="prixan" class="col-md-12 control-label">Prix à l'année</label>

                                <input id="prixan" type="number" class="form-control" name="prixan"
                                       value="{{$publication->prix_an}}" required>

                                @if ($errors->has('prix_an'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prix_an') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-xs-12 col-md-12 col-lg-12">
                                    <textarea id="description" rows="4" cols="50" class="form-control"
                                              name="description" required>{{$publication->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <label for="photo" class="col-md-12 control-label">Photo de présentation</label>
                                {!! Form::file('photo') !!}
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
@endsection
