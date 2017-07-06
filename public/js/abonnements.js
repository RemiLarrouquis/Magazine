
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
    $.get( "/Magazine/public/abonnement/list?full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

//Pagination dynamique (fonction à surcharger pour chaque modules "publications, abonnement, clients")
function pageToSurcharge(url) {
    $.get( url+"&full=false&"+filters(), function( data ) {
        $( "#list-view" ).html( data );
    });
}

// Récupération de la liste des paiements
function openModalPaiement(id) {
    $.get( "/Magazine/public/paiement/list?full=true&abo_id="+id, function( data ) {
        $( "#modale" ).html( data );
        $("#paiement-modal").modal('show');
    });
}

function updateModalPaiement(id) {
    $.get( "/Magazine/public/paiement/list?full=false&abo_id="+id, function( data ) {
        $( "#modalPaiementBody" ).html( data );
    });
}

function showRemb(num) {
    if ($("#remb"+num).hasClass('hideRemb')){
        $("#remb"+num).show();
        $("#remb"+num).removeClass('hideRemb')
    } else {
        $("#remb"+num).hide();
        $("#remb"+num).addClass('hideRemb')
    }
}

function valideRemb(num, max) {
    var montant = $("#montantRemb"+num).val();
    var cid = $("#cidRemb"+num).val();
    var tout = $("#toutRemb"+num).is(':checked');
    if (max < montant) {
        $("#errorRemb"+num).html('Montant supérieur à ' + max);
    } else {
        $.ajax({
            cache: false,
            url: "/Magazine/public/api/paiement/remboursement",
            type: "POST",
            data: {
                amount: montant,
                cid: cid,
                tout: tout
            },
            success: function (data) {
                var abo = $("#abo_id_remb"+num).val();
                updateModalPaiement(abo);
            },
            error:function (xhr, ajaxOptions, thrownError){
                if(xhr.status==404) {
                    $("#errorRemb"+num).html('Erreur veuillez actualiser la page.');
                }
            }
        });
    }
}