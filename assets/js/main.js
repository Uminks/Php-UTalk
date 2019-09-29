$(".sidebar-heading").height($(".bgCustomReverse").height() - 13);

$(document).ready(function () {
    $("#text-chat").emojioneArea();

    var height = $('.msg_history').height();
    $('.msg_history').stop().animate({
        scrollTop: height
    }, 2000);
});

// Menu Toggle
$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");

    if ($("#wrapper").hasClass("toggled")) $(".svgButton img").attr('src', 'assets/svg/visible.svg');
    else $(".svgButton img").attr('src', 'assets/svg/invisible.svg');

});