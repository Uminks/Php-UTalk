<?php

require_once "conexion.php";

class User extends Conexion {


    #REGISTRO DE USUARIOS
    #-------------------------------------
    public static function registerUserModel($data, $tabla){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (first_name, last_name, username, password, date, email) VALUES (:first_name, :last_name, :username, :password, :date, :email)");	

        $stmt->bindParam(":first_name", $data["first_name"], PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $data["last_name"], PDO::PARAM_STR);
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);

        if( $stmt->execute() ){
            return "success";
        }

        else{
            return "error";
        }

        $stmt->close();

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
        $stmt->close();

    }

    #VALIDAR USUARIO EXISTENTE
    #-------------------------------------
    public static function validateUserModel($data, $tabla){
        $stmt = Conexion::conectar()->prepare("SELECT username FROM $tabla WHERE username = :username OR email = :email");
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch();

        $stmt->close();

    }

    #BUSQUEDA DE USUARIO 
    #------------------------------------
    public static function searchUsersModel($data, $tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT id, first_name, last_name, username FROM $tabla WHERE username LIKE '%$data%'");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}