
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
    getLastsEchanges();
    getLastsAbonnements();
});

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

// Affichage des derniers abonnements du client
function getLastsAbonnements() {
    if ($("article").hasClass('details')) {
        var idClient = $("#idClient").val();
        $.get( "/abonnement/listClient?full=false&count=6&client_id="+idClient, function( data ) {
            $(data).insertAfter($( "#listAbonnement" ));
        });
    }
}

// Affichage des derniers échanges du client
function getLastsEchanges() {
    if ($("article").hasClass('details')) {
        var idClient = $("#idClient").val();
        $.get( "/historique/listClient?full=false&count=6&client_id="+idClient, function( data ) {
            $(data).insertAfter($( "#listEchanges" ));
        });
    }
}

// Edition de la fiche client
var edition = false;
var texte = $("#editClient").html();
function editFormClient() {
    if (!edition) {
        changeForm(false, "Enregistrer les modifications");
        edition = true;
    } else {
        changeForm(true, texte);
        edition = false;
    }
}

function changeForm(readonly, text) {
    $("input[class='form-control editable']").each(function() {
        $(this).attr('readonly', readonly);
    });
    $("select[class='form-control editable']").each(function() {
        $(this).attr('readonly', readonly);
        $(this).attr('disabled', readonly);
    });
    $("#editClient").html(text);

}