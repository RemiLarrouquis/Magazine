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

            @yield('content')

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

    <!-- Modale de message d'erreur -->
    <div class="modal fade" id="error-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-warning"></i> Attention</h4>
                </div>
                <div id="modalErrorBody" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modale de message success -->
    <div class="modal fade" id="success-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-check"></i> Succés</h4>
                </div>
                <div id="modalSuccessBody" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

