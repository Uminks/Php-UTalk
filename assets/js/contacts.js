$("#add-contact").change( (e) => {
    $("#add-contact-results").empty();
    let keyword = $("#add-contact").val();
    if ( keyword.lenght == 0 ) return;

    let _data = { 
        task: "search", 
        keyword: keyword
    };

    $.ajax({
		url: "controllers/UserController.php",
		method: "GET",
		data: _data,
		success:function(response){
            let data = JSON.parse(response);
			data.map( (item) => {
                let li ='<li class="contact">' +
                            '<div class="left-info">' +
                                '<img class="image-contact" src="assets/images/people2.png" alt="contact image">' +
                                '<h2 class="title-contact"> ' + item["first_name"] + ' ' + item["last_name"] + ' <span class="user-contact">' + item["username"] + '</span></h2>' +
                            '</div>' +
                            '<div class="options-contact">' +
                                '<a onclick="sendFriendRequest(this, ' + item["id"] + ')"> <img src="assets/svg/add-user.svg" title="Agregar usuario" alt="Agregar"> </a>' +
                            '</div>' +
                        '</li>';

                $("#add-contact-results").append(li);
            })
		}
	});
});

function sendFriendRequest (e, id) {
    let _data = { 
        to_user: id
    };
    let _this = e;
    $.ajax({
		url: "controllers/UserController.php?task=friend_request",
		method: "POST",
		data: _data,
		success:function(response){
            if(response == "success") {     
                $(_this).parent().parent().hide('slow').remove();
            }
		}
	});
}

$('a[href^="#solicitudes"]').click( (e) => {
    $("#ul-friend-requests").empty();
    let _data = { 
        task: "get_friend_request"
    };
    $.ajax({
        url: "controllers/UserController.php",
        method: "GET",
        data: _data,
        success:function(response){
            let data = JSON.parse(response);
			data.map( (item) => {
                let li = '<li class="contact">'+
                            '<div class="left-info">' +
                            '<div class="friend-info">' +
                                '<img class="image-contact" src="assets/images/people2.png" alt="contact image">' +
                            '</div>' +
                            '<h2 class="title-contact"> ' + item["first_name"] + ' ' + item["last_name"] + ' <span class="user-contact">('+ item["username"] +')</span></h2>' +
                            '</div>' +
                            '<div class="options-contact">' +
                                '<a onclick="acceptFriendRequest(this , ' + item["id"] + ')"> <img src="assets/svg/add-user.svg" title="Aceptar solicitud" alt="Aceptar"> </a>' +
                                '<a class="rejectFriend" onclick="deleteFriendRequest(this, ' + item["id"] + ')"> <img src="assets/svg/reject-user.svg" title="Rechazar solicitud" alt="Rechazar"> </a>' +
                            '</div>' +
                        '</li>';

                $("#ul-friend-requests").append(li);
            });
        }
    });
});

function acceptFriendRequest (e, id) {
    let _data = { 
        id_user: id
    };
    let _this = e;
    $.ajax({
		url: "controllers/UserController.php?task=accept_friend_request",
		method: "POST",
		data: _data,
		success:function(response){
            if(response == "success") {     
                $(_this).parent().parent().hide('slow').remove();
            }
		}
	});
}

function deleteFriendRequest (e, id) {
    let _data = { 
        id_user: id
    };
    let _this = e;
    $.ajax({
		url: "controllers/UserController.php?task=delete_friend_request",
		method: "POST",
		data: _data,
		success:function(response){
            if(response == "success") {     
                $(_this).parent().parent().hide('slow').remove();
            }
		}
	});
}

$('a[href^="#contactos"]').click( (e) => {
    $("#ul-contacts").empty();
    let _data = { 
        task: "get_contacts"
    };
    $.ajax({
        url: "controllers/UserController.php",
        method: "GET",
        data: _data,
        success:function(response){
            let data = JSON.parse(response);
			data.map( (item) => {
                let li = '<li class="contact">' +
                            '<div class="left-info">' +
                                '<div class="friend-info">' +
                                    '<img class="image-contact" src="assets/images/people2.png" alt="contact image">' +
                                    '<span class="friend-state" style="background: ' + getColorStatus( item["connection_status"] ) +';"></span>' +
                                '</div>' +
                                '<h2 class="title-contact"> ' + item["first_name"] + ' ' + item["last_name"] + ' <span class="user-contact">('+ item["username"] +')</span></h2>' +
                            '</div>' +
                            '<div class="options-contact">' +
                                '<a href="#"> <img src="assets/svg/new-message.svg" title="Nuevo mensaje" alt="Enviar mensaje"> </a>' +
                                '<a href="#"> <img src="assets/svg/invite-group.svg" title="Invitar grupo" alt="Invitar a grupo"> </a>' +
                                '<a class="friendDetails"  href="#"> <img src="assets/svg/detail-friend.svg" title="Detalles del contacto" alt="Ver detalles"> </a>' +
                                '<a href="#"> <img src="assets/svg/block-friend.svg" title="Bloquear contacto" alt="Bloquear"> </a>' +
                                '<a class="deleteFriend" href="#"> <img src="assets/svg/delete-friend.svg" title="Eliminar contacto" alt="Eliminar"> </a>' +
                            '</div>' +
                        '</li>';

                $("#ul-contacts").append(li);
            });
        }
    });

})

function getColorStatus (status) {
    switch(status){
        case '0': {
            return 'green';
        }
        case '1': {
            return 'orange';
        }
        case '2': {
            return 'darkred';
        }
        case '3': {
            return 'lightgray';
        }
    }
}