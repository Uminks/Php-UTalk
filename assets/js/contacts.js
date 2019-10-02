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
                                '<a onclick="sendFriendRequest(' + item["id"] + ')"> <img src="assets/svg/add-user.svg" title="Agregar usuario" alt="Agregar"> </a>' +
                            '</div>' +
                        '</li>';

                $("#add-contact-results").append(li);
            })
		}
	});
});

function sendFriendRequest (id) {
    let _data = { 
        to_user: id
    };

    $.ajax({
		url: "controllers/UserController.php?task=friend_request",
		method: "POST",
		data: _data,
		success:function(response){
            console.log(response); //Si es success poner animacion de enviada satisfactoriamente y eliminar
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
                                '<a onclick="acceptFriendRequest(' + item["id"] + ')"> <img src="assets/svg/add-user.svg" title="Aceptar solicitud" alt="Aceptar"> </a>' +
                                '<a class="rejectFriend" onclick="deleteFriendRequest(' + item["id"] + ')"> <img src="assets/svg/reject-user.svg" title="Rechazar solicitud" alt="Rechazar"> </a>' +
                            '</div>' +
                        '</li>';

                $("#ul-friend-requests").append(li);
            });
        }
    });
});

function acceptFriendRequest (id) {
    let _data = { 
        id_user: id
    };

    $.ajax({
		url: "controllers/UserController.php?task=accept_friend_request",
		method: "POST",
		data: _data,
		success:function(response){
            console.log(response); //Animacion de agregado a contactos y eliminar 
		}
	});
}

function deleteFriendRequest (id) {
    let _data = { 
        id_user: id
    };
    $.ajax({
		url: "controllers/UserController.php?task=delete_friend_request",
		method: "POST",
		data: _data,
		success:function(response){
            console.log(response); //Animacion de eliminacion de solicitud
		}
	});
}