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


// Pintar fill del estado
function printUserStatus(status){
    switch(status){
        case 0: {
            $('#stateBullet').css('fill', 'green');
            break;
        }
        case 1: {
            $('#stateBullet').css('fill', 'orange');
            break;
        }
        case 2: {
            $('#stateBullet').css('fill', 'darkred');
            break;
        }
        case 3: {
            $('#stateBullet').css('fill', 'lightgray');
            break;
        }
    }
}

// Setear Estado del Usuario
function updateUserStatus (status) {
    
    let _data = { 
        connection_status: status
    };

    console.log(_data);

    $.ajax({
		url: "controllers/UserController.php?task=update_status",
		method: "POST",
		data: _data,
		success:function(response){
            $('#status-update').modal('hide');
            printUserStatus(status);
		}
	});
}