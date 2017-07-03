
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

    // Pour les impyées sulement
    if (getURLParameter('filterPaye') != undefined) {
        $("#btnStatus").hide();
        $("article").removeClass("liste-abonnement").addClass("liste-abonnement-impaye");
        $("article").addClass("liste-abonnement-impaye");
        setMenus();
    }
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
var filtreStatus = getURLParameter('filterPaye');
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
    if (filtreStatus != '' && filtreStatus != undefined) {
        filtres += "filterPaye=" + filtreStatus + "&";
    }
    return filtres;
}

function reloadList() {
    $.get( "/abonnement/list?full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}