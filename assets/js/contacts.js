$("#add-contact").change( (e) => {
    $("#add-contact-results").empty();
    let keyword = $("#add-contact").val();
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
                                '<a onclick="addFriend(' + item["id"] + ')"> <img src="assets/svg/add-user.svg" title="Agregar usuario" alt="Agregar"> </a>' +
                                '<a href="#"> <img src="assets/svg/block-friend.svg" title="Bloquear usuario" alt="Bloquear"> </a>' +
                            '</div>' +
                        '</li>';

                $("#add-contact-results").append(li);
            })
		}
	});
});

function addFriend (id) {
    //Another ajax to send request to friend
}