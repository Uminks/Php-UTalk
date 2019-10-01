<?php


require_once "../models/User.php";

class UserController {

    const REGISTER = "register";
    const LOGIN = "login";
    const UPDATE = "update";
    const SEARCH_USERS = "search"; 
    const FRIEND_REQUEST = "friend_request";  
    const UPDATE_STATUS = "update_status";
    const GET_PERSONAL_DATA = "get_personal_data";
    const LOGOUT = "logout";

    public function initContent ( $task ) {

        $option = $_GET["task"];

        switch ( $option ) {
            case self::REGISTER : {
                $this->validateUserController();
                break;
            }
            case self::LOGIN : {
                $this->loginUserController();
                break;
            }
            case self::UPDATE : {
                break;
            }
            case self::SEARCH_USERS : {
                echo json_encode( $this->searchUsersController() );
                break;
            }
            case self::FRIEND_REQUEST : {
                $this->sendFriendRequestController();
                break;
            }
            case self::UPDATE_STATUS : {
                $this->setUserStatus();
                break;
            }
            case self::GET_PERSONAL_DATA : {
                $this->getPersonalDetails();
                break;
            }
            case self::LOGOUT : {
                $this->logoutUserController();
                break;
            }
        }
    }
    
    public function registerUserController () {

		if( isset($_POST["registerData"]) ){
            $respuesta = User::registerUserModel($_POST["registerData"], "users");
					
            if( $respuesta=="success" ) {
                header("location: /?success");
            }
            else{
                header("location: /?error");
            }
		}

	}

    private function loginUserController () {
        if( isset($_POST["loginData"]) ) {
            $data = $_POST["loginData"];

            $response = User::loginUserModel($data, "users");

            if (count($response["username"]) > 0) {
                #INICIAR SESION
                session_start();
                $_SESSION["user_information"] = $response;
                header("location: /chat");
            }
            else {
                header("location: /?error");
            }
        }
    }

    public function validateUserController () {

        if( isset($_POST["registerData"]) ) {
            $data = $_POST["registerData"];

            $response = User::validateUserModel($data, "users");

            if (count($response["username"]) > 0) {
                header("location: /?error");
            }
            else {
                $this->registerUserController();
            }
        } else {
            header("location: /");
        }

    }
    
    private function searchUsersController () {
        session_start();
        $data = [ "id" => $_SESSION["user_information"]["id"], "name" => $_GET["keyword"] ];
        $response = User::searchUsersModel($data, "users");
        return $response;
    }

    private function sendFriendRequestController () {
        session_start();
        $data = [ "from_user" => $_SESSION["user_information"]["id"], "to_user" => $_POST["to_user"] ];
        $response = User::sendFriendRequestModel( $data, "friend_requests" );
        return $response;
    }

    private function getPersonalDetails() {
        session_start();
        $data = [ "username" => $_SESSION["user_information"]["username"]];
        $response = User::getDataUserUpdate($data, "users");
        return $reponse;
    }

    private function setUserStatus() {
        session_start();
        $data = [ "username" => $_SESSION["user_information"]["username"], "connection_status" =>  $_POST["connection_status"] ];
        $reponse = User::updateUserStatus($data, "users");

        $_SESSION["user_information"]["connection_status"] = $_POST["connection_status"];
   
        return $response;
    }

    private function logoutUserController() {

        session_start();
        if(isset($_SESSION["user_information"])){
            $_SESSION["user_information"] = null;
        } 
        session_destroy();
        
        header("location: /");
    }


}

$user_controller = new UserController();
$user_controller->initContent($_GET["task"]);