
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
    $.get( "Magazine/public/client/list?full=false&"+filters(), function( data ) {
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
        $.get( "Magazine/public/abonnement/list?full=false&count=5&client_id="+idClient, function( data ) {
            $(data).insertAfter($( "#listAbonnement" ));
            hideUselessElements();
        });
    }
}

// Affichage des derniers échanges du client
function getLastsEchanges() {
    if ($("article").hasClass('details')) {
        var idClient = $("#idClient").val();
        $.get( "Magazine/public/historique/list?full=false&count=5&client_id="+idClient, function( data ) {
            $(data).insertAfter($( "#listEchanges" ));
            hideUselessElements();
        });
    }
}

function hideUselessElements() {
    // Masque la pagination
    $("nav[class='text-xs-right paginate']").hide();
    // Cache la colonne client
    $(".clientToHide").hide();
}

// Edition de la fiche client
var edition = false;
var texte = $("#editClient").html();
function editFormClient() {
    if (!edition) {
        changeForm(false, "Enregistrer les modifications");
    } else {
        $.ajax({
            url: $("#editForm").attr('action'),
            type: $("#editForm").attr('method'),
            data: $("#editForm").serialize(),
            success: function(data) {
                if (data.errors) {
                    var html = '<ul>';
                    for (var key in data.msg) {
                        html += '<li><strong>' + key + ' : </strong>' + data.msg[key][0] + '</li>';
                    }
                    html += '</ul>';
                    $("#modalErrorBody").html(html);
                    $("#error-modal").modal('show');
                } else {
                    changeForm(true, texte);
                    $("#modalSuccessBody").html(data.msg);
                    $("#success-modal").modal('show');
                }
            }
        });
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
    edition = !readonly;
}