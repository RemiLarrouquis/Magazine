@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @foreach ($publications as $publication)

                <div class="card">
                    <img class="card-img-top" src="{{url('uploads/'.$publication->fichier->nom_server)}}" alt="{{$publication->fichier->nom_fichier}}">
                    <div class="card-block">
                        <h4 class="card-title text-left">{{ $publication->titre }}</h4>
                        <small class="text-muted col-md-5">Prix : {{ $publication->prix_an }}€</small>
                        <small class="text-muted col-md-5">{{ $publication->nb_an }} / an</small>
                        <a class="col-md-2" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
@endsection
