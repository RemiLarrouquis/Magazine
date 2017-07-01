
$(function() {

    $("#search-nom").on('input', function() {
        filtreNom = $('#search-nom').val();
        reloadList();
    });
    $("#buttonConfirmMailSort").on('click', function() {
        if (filtreConfirm == 'true') {
            filtreConfirm = 'false';
        } else {
            filtreConfirm = 'true';
        }
        reloadList();
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

function reloadList() {
    $.get( "/client/list?full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}