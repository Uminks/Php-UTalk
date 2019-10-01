<?php

require_once "conexion.php";
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
class User extends Conexion {


    #REGISTRO DE USUARIOS
    #-------------------------------------
    public static function registerUserModel($data, $tabla){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (first_name, last_name, username, password, gender, date, email) VALUES (:first_name, :last_name, :username, :password, :gender, :date, :email)");	

        $stmt->bindParam(":first_name", $data["first_name"], PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $data["last_name"], PDO::PARAM_STR);
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindParam(":gender", $data["gender"], PDO::PARAM_STR);
        $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);

        if( $stmt->execute() ){
            return "success";
        }

        else{
            return "error";
        }
    }

    #INGRESO DE USUARIOS
    #-------------------------------------
    public static function loginUserModel($data, $tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ( username = :username OR email = :email ) AND ( password = :password )");
        $stmt->bindParam(":username", $data["user_email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data["user_email"], PDO::PARAM_STR);
        $stmt->execute();
        #fetch() Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement
        return $stmt->fetch();
    }

    #VALIDAR USUARIO EXISTENTE
    #-------------------------------------
    public static function validateUserModel($data, $tabla){
        $stmt = Conexion::conectar()->prepare("SELECT username FROM $tabla WHERE username = :username OR email = :email");
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    #BUSQUEDA DE USUARIO 
    #------------------------------------
    public static function searchUsersModel($data, $tabla) {
        $name = $data["name"];
        $stmt = Conexion::conectar()->prepare("SELECT id, first_name, last_name, username FROM $tabla WHERE username LIKE '%$name%' AND id != :id");
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #INSERTANDO SOLICITUD DE AMISTAD DE USUARIO 
    #------------------------------------
    public static function sendFriendRequestModel($data, $tabla) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( from_user, to_user, request_status ) VALUES ( :from_user, :to_user, 0 )");
        $stmt->bindParam(":from_user", $data["from_user"], PDO::PARAM_INT);
        $stmt->bindParam(":to_user", $data["to_user"], PDO::PARAM_INT);

        if( $stmt->execute() ){
            echo "success";
        }
        else{
            echo "error";
        }
    }
    
    
    #ACTUALIZAR DATA PERSONAL
    #-----------------------------------
    public static function updateUserData($data, $tabla) {
        if(isset($data["password"]) && strlen($data["password"]) > 0){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET first_name = :first_name, last_name = :last_name, password = :password, date = :date WHERE username = :username");
            $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        }else {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET first_name = :first_name, last_name = :last_name, date = :date WHERE username = :username");
        }
        
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":first_name", $data["first_name"], PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $data["last_name"], PDO::PARAM_STR);
        
        $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);

        if( $stmt->execute() ){
            echo $data;
        }
        else{
            echo "error";
        }
    }

    #ACTUALIZANDO ESTADO
    #------------------------------------ 
    public static function updateUserStatus($data, $tabla) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET connection_status = :connection_status WHERE username = :username");
        $stmt->bindParam(":connection_status", $data["connection_status"], PDO::PARAM_INT);
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);

        if( $stmt->execute() ){
            echo "success";
        }
        else{
            echo "error";
        }
    } 
}