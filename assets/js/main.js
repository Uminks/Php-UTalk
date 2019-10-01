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

//Remove animacion
function cuteHide(el) {
    el.animate({opacity: '0'}, 150, function(){
      el.animate({height: '0px'}, 150, function(){
        el.remove();
      });
    });
  }

//Rechazar Contactos animacion
  $('.rejectFriend').on('click', function(){
    var el = $(this).closest('.contact');
    cuteHide(el);
  });

//Eliminar Contactos animacion
  $('.deleteFriend').on('click', function(e){
    e.preventDefault();
    var el = $(this).closest('.contact');
    $("#confirmDelete").modal('show');

    $("#modal-btn-si").on("click", function(){
        cuteHide(el);
        $("#confirmDelete").modal('hide');
    });

    $("#modal-btn-no").on("click", function(){
        $("#confirmDelete").modal('hide');
        return false;
    });
    
  });


// Detalles de contacto
$('.friendDetails').on("click", function(e){
    e.preventDefault();
    $('#friendDetails').modal('show');
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



//Actualizar Informacion del usuario

let htmlAlert = '<div class="alert alert-success">Informacion actualizada con exito.</div>';
$("#success-message").append(htmlAlert).hide();

$('#update-info').submit(function(e){

    e.preventDefault(); 

    var _data = $('#update-info').serializeArray().reduce(function(obj, item) {
      obj[item.name] = item.value;
      return obj;
    }, {});
    
    $.ajax({
      url: "/controllers/UserController.php?task=update_user_data",
      method: "POST",
      data: _data,
      success:function(response){
          $("#success-message").first().hide().fadeIn(200).delay(2000).fadeOut(1000, function () { $('#success-message').hide(); });
      }
    });

   
});

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