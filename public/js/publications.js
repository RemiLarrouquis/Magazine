
$(function() {

    $("#search-titre").on('input', function() {
        filtreTitre = $('#search-titre').val();
        reloadList();
    });
    $("#buttonPrixSort").on('click', function() {
        if (filtrePrix == 'true') {
            filtrePrix = 'false';
        } else {
            filtrePrix = 'true';
        }
        reloadList();
    });
});

// Recherche dynamique des publications
var filtreTitre = '';
var filtrePrix = '';
function filters() {
    var filtres = ''
    if (filtreTitre != '') {
        filtres += "filterTitre=" + filtreTitre + "&";
    }
    if (filtrePrix != '') {
        filtres += "filterPrix=" + filtrePrix + "&";
    }
    return filtres;
}

function reloadList() {
    $.get( "Magazine/public/publication/list?full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}