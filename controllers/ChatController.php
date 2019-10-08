<?php

require_once "../models/Chat.php";

class ChatController {
    
    const GET_CHATS = "get_chats";
    const GET_ALL_MESSAGES = "get_all_messages";
    const SEND_MESSAGE = "send_message";
    const GET_NEW_MESSAGES = "get_new_messages";
    const UPLOAD_FILE = "upload_file";
    const ADD_USER = "add_users_to_chat";

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
                $this->sendMessageController();
                break;
            }
            case self::GET_NEW_MESSAGES : { 
                echo json_encode( $this->getNewMessagesController() );
                break;
            }
            case self::UPLOAD_FILE : {
                $this->uploadFileController();
                break;
            }
            case self::ADD_USER : {
                $this->addUserToChatController ();
            }
        }
    }

    private function getChatsController () {
        session_start();
        if ( isset($_SESSION["user_information"]["id"]) ) {
            $data = [ "id_to_user" => $_GET["id"] , "id" => $_SESSION["user_information"]["id"] ];
            $response = Chat::getChatsModel($data, "chats");
            
            return $response;
        }
        else {
            return false;
        }
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
            "date" => date("Y-m-d H:i:s"),
            "is_file" => 0
        ];

        $response = Chat::sendMessageModel($data, "messages");

        echo date("Y-m-d H:i:s");
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

    private function uploadFileController () {
        session_start();
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            $url = "uploads/" . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/' . $_FILES['file']['name']);
            
            $data = [ 
                "id_user" => $_SESSION["user_information"]["id"],
                "id_chat" => $_REQUEST["id_chat"],
                "message" => $url,
                "date" => date("Y-m-d H:i:s"),
                "is_file" => 1
            ];
    
            $response = Chat::sendMessageModel($data, "messages");

            $response = [
                'url' => $url,
                'date' => date("Y-m-d H:i:s")
            ];
            echo json_encode($response);
        }
    }

    private function addUserToChatController () {
        $data = [
            "id_chat" => $_POST["id_chat"],
            "name_user" => $_POST["name_user"],
            "channel_name" => $_POST["channel_name"]
        ];

        $response = Chat::addUserToChatModel ($data, "users_chat");
        
        return $response;
    }
}

$user_controller = new ChatController();
$user_controller->initContent($_GET["task"]);