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
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ url('/historique/save') }}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <div class="row col-xs-12">
                                            <div class="form-group{{ $errors->has('titre') ? ' has-error' : '' }} col-lg-4">
                                                <label for="titre" class="col-md-4 control-label">
                                                    Choisir un client
                                                </label>
                                                @if($selectedClient)
                                                    <input type="text" readonly="readonly" disabled="disabled"
                                                           class="form-control" id="email" value="{{$selectedClient->nom.' '.$selectedClient->prenom}}">
                                                    <input type="hidden" name="clients" value="{{$selectedClient->id}}">
                                                @else
                                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                                        <div class="magicsearch-wrapper" data-belong="magicsearch" style="width: 350px; display: inline-block; float: none; margin: 0px; min-width: 101px;" data-index="1">
                                                            <input class="magicsearch multi" id="basic" name="clients" data-placeholder="search names..." data-id="" style="margin: 0px; box-sizing: border-box; width: 350px; height: 56px; padding-left: 10px; min-width: 101px; padding-top: 5px;" placeholder="search names...">
                                                            <div class="magicsearch-box all" style="top: 56px; max-height: 248px; display: none;"></div>
                                                            <div class="multi-items" style="top: 8px; left: 8px; bottom: 8px; right: 8px;"></div>
                                                        </div>

                                                        @if ($errors->has('titre'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('titre') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="titre" class="col-md-4 control-label">
                                                    Global pour tous les clients
                                                </label>
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <input type="checkbox" name="tous" id="checkTous">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <div class="col-xs-12">
                                            <div class="row form-group{{ $errors->has('titre') ? ' has-error' : '' }}">
                                                <label for="titre" class="col-md-4 control-label">
                                                    Type de relation
                                                </label>

                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <select class="form-control" name="type_id">
                                                        <option selected disabled>Choisissez le type de relation...</option>
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
    <script>
        $(function () {
            var dataSource = [
            @foreach($clients as $client)
                {id: {{$client->id}}, firstName: '{{$client->prenom}}', lastName: '{{$client->nom}}'},
            @endforeach
            ];

            $('#basic').magicsearch({
                dataSource: dataSource,
                fields: ['firstName', 'lastName'],
                id: 'id',
                format: '%firstName% %lastName%',
                multiple: true,
                focusShow: true,
                hidden: true,
                multiField: 'firstName',
                multiStyle: {
                    space: 5,
                    width: 80
                }
            });
        });
    </script>
    <script src="{{ asset('js/historique.js') }}"></script>
@endsection
