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
            console.log(response);
		}
	});
}