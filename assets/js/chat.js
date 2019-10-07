let newMessagesListener;
let getChatsListener;

function getChats (id = 'null') {
    $("#chats-index").empty();
    let _data = { 
        task: "get_chats", 
        id: id
    };
    $.ajax({
		url: "controllers/ChatController.php",
		method: "GET",
		data: _data,
		success:function(response){
            if ( response != "false" ) {
                let data = JSON.parse(response);
                data.map( (item) => {
                    let li = '<li onclick="loadMessages(' + item['id'] + ')">' +
                                '<img src="assets/images/people2.png" alt="sunil">' +
                                '<div class="content-chat">' +
                                '<div class="info-content">' +
                                    '<h2 class="top-content"> ' + item["name"] + ' </h2>' +
                                    '<span> ' + item["date"] + ' </span>' +
                                '</div>' +
                                '<p class="message-content">' + item['last_message'] + '</p>' +
                                '</div>' +  
                            '</li>';
                    $("#chats-index").append(li);
                });
            } 
		}
	});
}

function loadMessages ( id_chat ) {
    
    if ( typeof newMessagesListener !== 'undefined' ) {
        clearInterval(newMessagesListener);
    }
    $('.msg_history').empty();
    let _data = { 
        task: "get_all_messages",
        id_chat: id_chat
    };
    $('.user-chat').data("id", id_chat);
    $.ajax({
		url: "controllers/ChatController.php",
		method: "GET",
		data: _data,
		success: function(response){
            let data = JSON.parse(response);
            let message;
			data["messages"].map( (item) => {
                let text;
                if ( data["current_user"] == item["id_user"] ) {
                    ( item["is_file"] == 0 ) ? text = item["message"]  : text = '<a target="_blank" href="/' + item["message"] + '">' + item["message"] + '</a>';
                    message =   '<div class="outgoing_msg">' +
                                    '<div class="sent_msg">' +
                                    '<p>' + text + '</p>' +
                                    '<span class="time_date"> 11:01 AM    |    June 9</span>' +
                                    '</div>' +
                                '</div>';
                } 
                else {
                    ( item["is_file"] == 0 ) ? text = item["message"]  : text = '<a target="_blank" href="/' + item["message"] + '">' + item["message"] + '</a>';
                    message =   '<div class="incoming_msg">' +
                                    '<div class="incoming_msg_img"> <img src="assets/images/people2.png" alt="sunil"> </div>' +
                                    '<div class="received_msg">' +
                                    '<div class="received_withd_msg">' +
                                        '<p> ' + text+ ' </p>' +
                                        '<span class="time_date"> 11:01 AM    |    June 9</span></div>' +
                                    '</div>' +
                                '</div>'
                }

                $('.msg_history').append(message);
            }); 
            $(".msg_history").animate({ scrollTop: $(".msg_history").height() }, 1000);
		}
    });
    
    newMessagesListener = setInterval ( () => {
        loadNewMessages( id_chat );
    }, 1000);
}

$(".user-chat").submit( (e) => {
    e.preventDefault();

    let msg;
    if ( $('.emojionearea-editor').is(":visible") ) {
        msg = $('.emojionearea-editor').html().replace(/<div>(.*?)<\/div>/g,"<br>");
    }
    else {
        msg = $('.text-chat').val();
    }

    let _data = {
        message: msg,
        id_chat: $('.user-chat').data("id")
    }
    $.ajax({
		url: "controllers/ChatController.php?task=send_message",
		method: "POST",
		data: _data,
		success: function(response){
            let message =   '<div class="outgoing_msg">' +
                                '<div class="sent_msg">' +
                                '<p>' + _data.message + '</p>' +
                                '<span class="time_date"> 11:01 AM    |    June 9</span>' +
                                '</div>' +
                            '</div>';
            $('.msg_history').append(message);

            $('.emojionearea-editor').html('');
            $(".msg_history").animate({ scrollTop: $(".msg_history").height() }, 1000);
		}
	});
})

function loadNewMessages ( id_chat ) {
    let _data = { 
        task: "get_new_messages",
        id_chat: id_chat
    };
    $.ajax({
		url: "controllers/ChatController.php",
		method: "GET",
		data: _data,
		success: function(response){
            let text;
            let data = JSON.parse(response);
			data.map( (item) => {
                ( item["is_file"] == 0 ) ? text = item["message"]  : text = '<a target="_blank" href="/' + item["message"] + '">' + item["message"] + '</a>';
                let message =   '<div class="incoming_msg">' +
                                    '<div class="incoming_msg_img"> <img src="assets/images/people2.png" alt="sunil"> </div>' +
                                    '<div class="received_msg">' +
                                    '<div class="received_withd_msg">' +
                                        '<p> ' + text + ' </p>' +
                                        '<span class="time_date"> 11:01 AM    |    June 9</span></div>' +
                                    '</div>' +
                                '</div>'
                
                $('.msg_history').append(message);
                $(".msg_history").animate({ scrollTop: $(".msg_history").height() }, 1000);
            }); 
            
		}
    });
}

$(document).ready( (e) => {
    getChats(); 
})

$('a[href^="#conversaciones"]').click( (e) => {
    getChats(); 
});

$('#upload').change( (e) => {


    var file = e.target.files[0];
    var form_data = new FormData();
    form_data.append('file', file);
    form_data.append('id_chat', $('.user-chat').data("id"));

    $.ajax({
		url: "controllers/ChatController.php?task=upload_file",
		method: "POST",
        data: form_data,
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
		success: function(response) {
            console.log(response);
            let message =   '<div class="outgoing_msg">' +
                                '<div class="sent_msg">' +
                                '<p><a href="' + response + '" target="_blank">' + response + '</p>' +
                                '<span class="time_date"> 11:01 AM    |    June 9</span>' +
                                '</div>' +
                            '</div>';
            $('.msg_history').append(message);
            $(".msg_history").animate({ scrollTop: $(".msg_history").height() }, 1000);
}
    });
})