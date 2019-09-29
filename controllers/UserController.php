<?php


require_once "../models/User.php";

class UserController {

    const REGISTER = "register";
    const LOGIN = "login";
    const UPDATE = "update";
    const SEARCH_USERS = "search";  

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
        $name = $_GET["keyword"];
        $response = User::searchUsersModel($name, "users");
        return $response;
    }

}

$user_controller = new UserController();
$user_controller->initContent($_GET["task"]);