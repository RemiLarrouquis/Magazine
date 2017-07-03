$(function() {
    setMenus();
});

function setMenus() {
    var menus = [
        "liste-client",
        "liste-historique"
    ];
    var subMenus = [
        "liste-publication",
        "liste-abonnement",
        "liste-abonnement-impaye",
        "fiche-publication"
    ];

    // On commence par vérifier qu'aucun autre element n'est actif
    $("ul[class='collapse in'] li").each(function() {
        $(this).removeClass('active')
    });

    menus.forEach(function(element) {
        if ($("article").hasClass(element)) {
            activeMenu('#' + element);
        }
    });
    subMenus.forEach(function(element) {
        if ($("article").hasClass(element)) {
            openSubMenu('#' + element);
        }
    });
}

function openSubMenu(name) {
    $(name).parent().addClass("active");
    $(name).parent().parent().css("height", "");
    $(name).parent().parent().addClass("in");
    $(name).parent().parent().parent().addClass("open active");
}

function activeMenu(name) {
    $(name).parent().addClass("active");
}

function getURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}