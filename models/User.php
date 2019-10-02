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
        
        $stmt = Conexion::conectar()->prepare(
            "SELECT u.id, u.first_name, u.last_name, u.username
                FROM $tabla u
                WHERE 
                    u.username LIKE '%$name%'
                    AND u.id != 2
                    AND u.id NOT IN  (
                        SELECT from_user FROM friend_requests WHERE to_user = :id
                    )
                    AND u.id NOT IN ( 
                        SELECT to_user FROM friend_requests WHERE from_user = :id
                    )
            "
        );
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #INSERTANDO SOLICITUD DE AMISTAD DE USUARIO 
    #------------------------------------
    public static function sendFriendRequestModel($data, $tabla) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( from_user, to_user ) VALUES ( :from_user, :to_user )");
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

    #OBTENIENDO SOLICITUDES DE AMISTAD
    #-------------------------------------
    public static function getFriendRequestsModel($data, $tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM users u INNER JOIN friend_requests fr ON u.id = fr.from_user WHERE fr.to_user = :id AND fr.request_status = 0");
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #ACEPTANDO SOLICITUDES DE AMISTAD
    #-------------------------------------
    public static function acceptFriendRequestsModel ($data, $tabla){
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla ( id_user, id_user_friend ) VALUES ( :id_user, :id );
             INSERT INTO $tabla ( id_user, id_user_friend ) VALUES ( :id, :id_user );
             UPDATE friend_requests SET request_status = 1 WHERE from_user = :id_user AND to_user = :id
        ");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_INT);

        if( $stmt->execute() ){
            echo "success";
        }
        else{
            echo "error";
        }
    }

    #ELIMINANDO SOLICITUDES DE AMISTAD
    #-------------------------------------
    public static function deleteFriendRequestsModel ($data, $tabla){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE from_user = :id_user AND to_user = :id");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_INT);

        if( $stmt->execute() ){
            echo "success";
        }
        else{
            echo "error";
        }
    }

    # OBTENIENDO CONTACTOS
    #-------------------------------------
    public static function gerContactsModel($data, $tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla u INNER JOIN friends f ON  u.id = f.id_user_friend WHERE f.id_user = :id");
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}