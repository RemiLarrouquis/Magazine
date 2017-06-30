
$(function() {

    $("#search-titre").on('input', function() {
        filtreTitre = $('#search-titre').val();
        reloadList();
    });
    $("#buttonDateFin").on('click', function() {
        if (filtreDateFin == 'false') {
            filtreDateFin = 'true';
        } else {
            filtreDateFin = 'false';
        }
        reloadList();
    });
});

function filterEtat(id, libelle) {
    filtreEtat = id;
    $("#etatBtn").html(libelle);
    reloadList();
}
function filterStatus(id, libelle) {
    filtreStatus = id;
    $("#statusBtn").html(libelle);
    reloadList();
}

// Recherche dynamique des publications
var filtreTitre = '';
var filtreDateFin = '';
var filtreEtat = '';
var filtreStatus = '';
function filters() {
    var filtres = '';
    if (filtreTitre != '') {
        filtres += "filtreTitre=" + filtreTitre + "&";
    }
    if (filtreDateFin != '') {
        filtres += "orderByDateFin=" + filtreDateFin + "&";
    }
    if (filtreEtat != '') {
        filtres += "filterEtat=" + filtreEtat + "&";
    }
    if (filtreStatus != '') {
        filtres += "filterPaye=" + filtreStatus + "&";
    }
    return filtres;
}

function reloadList() {
    $.get( "/abonnement/list?"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}