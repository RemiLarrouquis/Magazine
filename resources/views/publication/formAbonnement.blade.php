<section class="section">
    <div class="row sameheight-container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-12 title-block">
                            <h4>{{$publication->titre}}</h4>
                        </div>
                        <div class="col-md-12" style="margin-bottom:20px;">
                            <span class="col-md-10">{{$publication->description}}</span><img
                                    src="{{$publication->image}}" style="height:100px;">
                        </div>
                    </div>
                    <div class="col-md-12 center">
                        <div class="col-md-12">
                            <span><b>Choisir les clients que vous voulez abonner à la publication</b></span>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url('/abonnement/save') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input id="id" type="text" class="form-control" name="id" hidden="true"
                               value="{{$publication->id}}">
                        <div class="form-group{{ $errors->has('titre') ? ' has-error' : '' }} col-md-6">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="magicsearch-wrapper" data-belong="magicsearch"
                                     style="width: 350px; display: inline-block; float: none; margin: 0px; min-width: 101px;"
                                     data-index="1">
                                    <input class="magicsearch multi" id="basic" name="clients"
                                           data-placeholder="Entrez un nom..." data-id=""
                                           style="margin: 0px; box-sizing: border-box; width: 450px; height: 56px; padding-left: 10px; min-width: 101px; padding-top: 5px;"
                                           placeholder="Entrez un nom...">
                                    <div class="magicsearch-box all"
                                         style="top: 56px; max-height: 248px; display: none;"></div>
                                    <div class="multi-items"
                                         style="top: 8px; left: 8px; bottom: 8px; right: 8px;"></div>
                                </div>

                                @if ($errors->has('titre'))
                                    <span class="help-block">
                                                                <strong>{{ $errors->first('titre') }}</strong>
                                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-offset-1 col-md-5">
                            <button style="margin-left:50px;" type="submit" class="btn btn-primary">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var dataSource = [
                    @foreach($clients as $client)
                {
                    id: {{$client->id}}, firstName: '{{$client->prenom}}', lastName: '{{$client->nom}}'
                },
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
</section>