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



// Detalles del contacto
  function friendDetails(user,e){

    let _data = { 
      username: user
    };
    e.preventDefault();
    
          
    $.ajax({
        url: "controllers/UserController.php?task=get_contact_details",
        method: "GET",
        data: _data,
        success:function(response){
            let data = JSON.parse(response);
        
            $('#name-contact').first().text(data[0].first_name);
            $('#last-name-contact').first().text(data[0].last_name);
            $('#user-contact').first().text(data[0].username);
            $('#age-contact').first().text(moment().diff(moment(new Date(data[0].date)), 'years'));
            $('#gender-contact').first().text(() => {
               if(data[0].gender == "male"){
                 return "Hombre";
               }
               else if(data[0].gender == "female"){
                 return "Mujer";
               }
               else {
                 return "Prefiero no decirlo";
               }
            });
            $('.friend-state-details').first().css("background", getColorStatus(data[0].connection_status));
            $('#friendDetails').modal('show');
        }
    });
  }

//Remove animacion
function cuteHide(el) {
  el.animate({
      opacity: '0'
  }, 150, function() {
      el.animate({
          height: '0px'
      }, 150, function() {
          el.remove();
      });
  });
}

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
