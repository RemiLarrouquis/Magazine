
$(function() {

    $("#search-nom").on('input', function() {
        filtreNom = $('#search-nom').val();
        reloadList();
    });
});

function filterType(id, libelle) {
    filtreType = id;
    $("#typeBtn").html(libelle);
    reloadList();
}

var filtreNom = '';
var filtreType = '';
var filtreClient = getURLParameter('client_id');
function filters() {
    var filtres = ''
    if (filtreNom != '') {
        filtres += "filterNom=" + filtreNom + "&";
    }
    if (filtreType != '') {
        filtres += "filterType=" + filtreType + "&";
    }
    if (filtreClient != '' && filtreClient != undefined) {
        filtres += "client_id=" + filtreClient + "&";
    }
    return filtres;
}

function reloadList() {
    $.get( "/Magazine/public/historique/list?full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

