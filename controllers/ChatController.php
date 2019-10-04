<?php

require_once "../models/Chat.php";

class ChatController {
    
    const GET_CHATS = "get_chats";

    public function initContent ( $task ) { 
        $option = $_GET["task"];

        switch ( $option ) { 
            case self::GET_CHATS : {
                echo json_encode( $this->getChatsController() );
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
}

$user_controller = new ChatController();
$user_controller->initContent($_GET["task"]);