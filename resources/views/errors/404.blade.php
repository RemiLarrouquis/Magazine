@extends('layouts.app')

@section('app')

    <div class="app blank sidebar-opened">
        <article class="content">
            <div class="error-card global">
                <div class="error-title-block">
                    <h1 class="error-title">404</h1>
                    <h2 class="error-sub-title"> Désolé, mais cette page n'existe pas </h2>
                </div>
                <div class="error-container">
                    <a class="btn btn-primary" href="/"> <i class="fa fa-angle-left"></i> Retour au site </a>
                </div>
            </div>
        </article>
    </div>
    <!-- Reference block for JS -->
    <div class="ref" id="ref">
        <div class="color-primary"></div>
        <div class="chart">
            <div class="color-primary"></div>
            <div class="color-secondary"></div>
        </div>
    </div>

@endsection