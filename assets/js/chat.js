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
                if ( data["current_user"] == item["id_user"] ) {
                    message =   '<div class="outgoing_msg">' +
                                    '<div class="sent_msg">' +
                                    '<p>' + item["message"] + '</p>' +
                                    '<span class="time_date"> 11:01 AM    |    June 9</span>' +
                                    '</div>' +
                                '</div>';
                } 
                else {
                    message =   '<div class="incoming_msg">' +
                                    '<div class="incoming_msg_img"> <img src="assets/images/people2.png" alt="sunil"> </div>' +
                                    '<div class="received_msg">' +
                                    '<div class="received_withd_msg">' +
                                        '<p> ' + item["message"] + ' </p>' +
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
            let data = JSON.parse(response);
			data.map( (item) => {
                let message =   '<div class="incoming_msg">' +
                                    '<div class="incoming_msg_img"> <img src="assets/images/people2.png" alt="sunil"> </div>' +
                                    '<div class="received_msg">' +
                                    '<div class="received_withd_msg">' +
                                        '<p> ' + item["message"] + ' </p>' +
                                        '<span class="time_date"> 11:01 AM    |    June 9</span></div>' +
                                    '</div>' +
                                '</div>'
                
                $('.msg_history').append(message);
            }); 
            $(".msg_history").animate({ scrollTop: $(".msg_history").height() }, 1000);
		}
    });
}

$(document).ready( (e) => {
    getChats(); 
})

$('a[href^="#conversaciones"]').click( (e) => {
    getChats(); 
});