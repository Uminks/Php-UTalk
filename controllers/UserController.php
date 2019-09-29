<?php


require_once "../models/User.php";

class UserController {

    const REGISTER = "register";
    const LOGIN = "login";

    public function initContent ( $task ) {

        $option = $_GET["task"];

        switch ( $option ) {
            case self::REGISTER : {
                $this->validateUserController();
                break;
            }
            case self::LOGIN : {
                $this->loginUserController();
            }
        }
    }
    
    public function registerUserController(){

		if( isset($_POST["registerData"]) ){
            $respuesta = User::registerUserModel($_POST["registerData"], "users");
					
            if( $respuesta=="success" ) {
                #INICIAR SESION
                header("location: /chat");
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
                header("location: /chat");
            }
            else {
                header("location: /?error");
            }
        }
    }

    public function validateUserController(){

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

}

$user_controller = new UserController();
$user_controller->initContent($_GET["task"]);