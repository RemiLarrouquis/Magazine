$(function() {

    var menus = [
        "liste-publication",
        "liste-historique"
    ];
    var subMenus = [
        "liste-abonnement",
        "liste-client"
    ]

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

});

function openSubMenu(name) {
    $(name).parent().addClass("active");
    $(name).parent().parent().css("height", "");
    $(name).parent().parent().addClass("in");
    $(name).parent().parent().parent().addClass("open active");
}

function activeMenu(name) {
    $(name).parent().addClass("active");
}
