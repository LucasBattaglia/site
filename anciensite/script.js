$(document).ready(function() {
    checkHash();
    $(".menuTitre").click(function() {
        if ($(this).attr("title") === "hide") {
            $(".boxMenu").removeClass("mide");
            $(this).attr("title", "show");
        } else {
            $(".boxMenu").addClass("mide");
            $(this).attr("title", "hide");
        }
    });

    $(".accueil").click(function() {
        document.location.hash = "p=accueil";
    });
    $(".news").click(function() {
        document.location.hash = "p=news";
    });
    $(".projets").click(function() {
        document.location.hash = "p=projets";
    });
    $(".forum").click(function() {
        document.location.hash = "p=forum";
    });
    $(".contact").click(function() {
        document.location.hash = "p=contact";
    });
    $(window).on('hashchange', function() {
        checkHash();
    });


});

function checkHash() {
    var hash = document.location.hash;
    hash = hash.replace("#", "");
    var h = hash.split("&");
    if (h[0].indexOf("p=") !== -1) {
        var loc = h[0].replace("p=", "");
        $("#commonDiv").attr("title", loc);
        $("#commonDiv").fadeOut(100, function(loc) {
            $("#commonDiv").addClass("isdown");
            $.ajax({
                type: 'GET',
                url: "case/" + $("#commonDiv").attr("title") + ".html",
                success: function(data) {
                    $("#commonDiv").html(data);
                    $("#commonDiv").fadeIn(300);
                    $("#commonDiv").removeClass("isdown");
                }
            });
        });
    }
}