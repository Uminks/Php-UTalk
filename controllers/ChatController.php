<?php

require_once "../models/Chat.php";

class ChatController {
    
    const GET_CHATS = "get_chats";
    const GET_ALL_MESSAGES = "get_all_messages";
    const SEND_MESSAGE = "send_message";
    const GET_NEW_MESSAGES = "get_new_messages";

    public function initContent ( $task ) { 
        $option = $_GET["task"];

        switch ( $option ) { 
            case self::GET_CHATS : {
                echo json_encode( $this->getChatsController() );
                break;
            }
            case self::GET_ALL_MESSAGES : { 
                echo json_encode( $this->getAllMessagesController() );
                break;
            }
            case self::SEND_MESSAGE : {
                 $this->sendMessageController() ;
                break;
            }
            case self::GET_NEW_MESSAGES : { 
                echo json_encode( $this->getNewMessagesController() );
                break;
            }
        }
    }

    private function getChatsController () {
        session_start();
        $data = [ "id_to_user" => $_GET["id"] , "id" => $_SESSION["user_information"]["id"] ];
        $response = Chat::getChatsModel($data, "chats");
        
        return $response;
    }

    private function getAllMessagesController () {
        session_start();
        $data = [ "id_chat" => $_GET["id_chat"], "id_user" => $_SESSION["user_information"]["id"]];
        $messages = Chat::getAllMessagesModel( $data, "messages" );

        $response = [ "current_user" => $_SESSION["user_information"]["id"], "messages" => $messages ];
        return $response;
    }

    private function sendMessageController () {
        session_start();
        $data = [ 
            "id_user" => $_SESSION["user_information"]["id"],
            "id_chat" => $_POST["id_chat"],
            "message" => $_POST["message"],
            "date" => date("Y-m-d H:i:s")
        ];

        $response = Chat::sendMessageModel($data, "messages");
    }

    private function getNewMessagesController () {
        session_start();
        $data = [ 
            "id_user" => $_SESSION["user_information"]["id"],
            "id_chat" => $_GET["id_chat"]
        ];
        $response = Chat::getNewMessagesModel($data, "messages");
        return $response;
    }
}

$user_controller = new ChatController();
$user_controller->initContent($_GET["task"]);