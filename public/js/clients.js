
$(function() {

    $("#search-nom").on('input', function() {
        filtreNom = $('#search-nom').val();
        $.get( "/client/list?"+filters(), function( data ) {
            $( "#list-view" ).html( data );
        });
    });
    $("#buttonConfirmMailSort").on('click', function() {
        if (filtreConfirm == 'true') {
            filtreConfirm = 'false';
        } else {
            filtreConfirm = 'true';
        }
        $.get( "/client/list?"+filters(), function( data ) {
            $( "#list-view" ).html( data );
        });
    });
});

// Recherche dynamique des publications
var filtreNom = '';
var filtreConfirm = '';
function filters() {
    var filtres = ''
    if (filtreNom != '') {
        filtres += "filterNom=" + filtreNom + "&";
    }
    if (filtreConfirm != '') {
        filtres += "filtreConfirm=" + filtreConfirm + "&";
    }
    return filtres;
}

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}