@extends('layouts.app')

@section('app')
    <div class="main-wrapper">
        <div class="app" id="app">
            <header class="header">
                <div class="header-block header-block-nav">
                    @include('nav.navbar')
                </div>
            </header>
            <aside class="sidebar">
                <div class="sidebar-container">
                    @include('nav.sidebar')
                </div>
            </aside>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <article class="content dashboard-page">
                <section class="section">
                    <div class="row sameheight-container">
                        @yield('content')
                    </div>
                </section>
            </article>
            <footer class="footer">
                <div class="footer-block buttons">
                    <iframe class="footer-github-btn"
                                src="https://ghbtns.com/github-btn.html?user=RemiLarrouquis&repo=magazine&type=star&count=true"
                            frameborder="0" scrolling="0" width="140px" height="20px"></iframe>
                </div>
                <div class="footer-block author">
                    <ul>
                        <li> Créé par Rémi Larrouquis </li>
                        <li> Ludovic Girard </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
@endsection

