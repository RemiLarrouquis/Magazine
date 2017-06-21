
$(function() {

    $("#search-titre").on('input', function() {
        filtreTitre = $('#search-titre').val();
        $.get( "/publication/list?"+filters(), function( data ) {
            $( "#list-view" ).html( data );
        });
    });
    $("#buttonPrixSort").on('click', function() {
        if (filtrePrix == 'true') {
            filtrePrix = 'false';
        } else {
            filtrePrix = 'true';
        }
        $.get( "/publication/list?"+filters(), function( data ) {
            $( "#list-view" ).html( data );
        });
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

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}