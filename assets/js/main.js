$(".sidebar-heading").height($(".bgCustomReverse").height() - 13);

// Menu Toggle
$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");

    if ($("#wrapper").hasClass("toggled")) $(".svgButton img").attr('src', '../assets/svg/visible.svg');
    else $(".svgButton img").attr('src', '../assets/svg/invisible.svg');

});