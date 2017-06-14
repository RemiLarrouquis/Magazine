@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>

                @foreach ($publications as $publication)
                    <img src="{{url('uploads/'.$publication->fichier->nom_fichier)}}" alt="test">
                    <h4>{{ $publication->titre }}</h4>
                    <p>{!! nl2br($publication->description) !!}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
