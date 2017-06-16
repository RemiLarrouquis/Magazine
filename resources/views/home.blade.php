@extends('layouts.home')

@section('content')

    <article class="content dashboard-page">
        <section class="section">
            <div class="row sameheight-container">
                <div class="row">
                    @include('publication.cards')
                </div>
            </div>
        </section>
    </article>


@endsection
