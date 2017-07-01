@extends('layouts.home')

@section('content')
    <article class="content dashboard-page liste-publication">
        <div class="title-block">
            <h3 class="title"> Publications </h3>
            <p class="title-description"> {{ $sub_title }} </p>
        </div>
        <section class="section">
            <div class="row sameheight-container">
                <div class="row">
                    <div @if($publication->id != null) class="col-md-10" @else class="col-lg-12" @endif>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ url('/publication/save') }}"
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
                                            <label for="nban" class="col-md-12 control-label">Nombre par
                                                an</label>
                                            <input id="nban" type="number" class="form-control" name="nb_an"
                                                   value="{{$publication->nb_an}}" required>

                                            @if ($errors->has('nb_an'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('nb_an') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label for="prixan" class="col-md-12 control-label">Prix à
                                                l'année</label>

                                            <input id="prixan" type="number" class="form-control"
                                                   name="prix_an"
                                                   value="{{$publication->prix_an}}" required>

                                            @if ($errors->has('prix_an'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('prix_an') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description"
                                               class="col-md-4 control-label">Description</label>

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
                                            <label for="photo" class="col-md-12 control-label">Photo de
                                                présentation</label>
                                            {!! Form::file('photo', $attributes = array('id' => 'imgInp')) !!}
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
                    <script>
                        $("#titre").on('input', function () {
                            $("#titreCard").text($("#titre").val());
                        });
                        $("#prixan").on('input', function () {
                            $("#prixanCard").text("Prix : " + $("#prixan").val() + "€");
                        });
                        $("#nban").on('input', function () {
                            $("#nbanCard").text($("#nban").val() + " / an");
                        });
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function (e) {
                                    $('#blah').attr('src', e.target.result);
                                }

                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                        $("#imgInp").change(function () {
                            readURL(this);
                        });

                    </script>
                    @if($publication->id != null)
                        <div class="col-md-2">
                            <div class="panel-heading">Prévisualitation</div>
                            <div class="card">
                                <img class="card-img-top" id="blah"
                                     src="{{ $publication->image}}"
                                     alt="Image de présentations" height="300" width="225">
                                <div class="card-block">
                                    <h4 class="card-title text-left" id="titreCard">{{ $publication->titre }}</h4>
                                    <small class="text-muted col-md-5" id="prixanCard">Prix
                                        : {{ $publication->prix_an }}€
                                    </small>
                                    <small class="text-muted col-md-5" id="nbanCard">{{ $publication->nb_an }} / an
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </article>
@endsection
