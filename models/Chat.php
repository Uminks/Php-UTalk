<?php
require_once "conexion.php";
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
class Chat extends Conexion {

    public static function getChatsModel ($data, $tabla) {

        if ( $data["id_to_user"] != 'null' ) {
            $stmt = Conexion::conectar()->prepare("SELECT uc.id_user FROM users_chat uc WHERE uc.id_chat IN ( SELECT id_chat FROM users_chat WHERE id_user = :id ) AND uc.id_user != :id;");
            $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
            $stmt->execute();
            
            $to_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ( !in_array( [ "id_user" => $data["id_to_user"] ] , $to_users) ) {
                $stmt = Conexion::conectar()->prepare("SELECT first_name, last_name FROM users WHERE id = :id");
                $stmt->bindParam(":id", $data["id_to_user"], PDO::PARAM_INT);
                $stmt->execute();

                $name = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $name["first_name"] . ' ' . $name["last_name"];

                $stmt = Conexion::conectar()->prepare("INSERT INTO chats (name) VALUES (:name)");
                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->execute();

                $stmt = Conexion::conectar()->prepare("SELECT id FROM chats ORDER BY id DESC LIMIT 1");
                $stmt->execute();
                $id_chat = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt = Conexion::conectar()->prepare(
                    "INSERT INTO users_chat ( id_user, id_chat ) VALUES ( :id, :id_chat );
                     INSERT INTO users_chat ( id_user, id_chat ) VALUES ( :id_to_user, :id_chat )"
                );
                $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
                $stmt->bindParam(":id_to_user", $data["id_to_user"], PDO::PARAM_INT);
                $stmt->bindParam(":id_chat", $id_chat["id"], PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        $stmt = Conexion::conectar()->prepare("SELECT c.id, c.name FROM $tabla c INNER JOIN users_chat uc ON c.id = uc.id_chat WHERE uc.id_user = :id");
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->execute();
        
        $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response = array();
        foreach ( $chats as $chat ) {
            $stmt = Conexion::conectar()->prepare("SELECT message, date FROM messages  WHERE id_chat = :id_chat ORDER BY date DESC");
            $stmt->bindParam(":id_chat", $chat["id"], PDO::PARAM_INT);
            $stmt->execute();

            $last_message = $stmt->fetch(PDO::FETCH_ASSOC);

            $response[] = [
                "id" => $chat["id"],
                "name" => $chat["name"],
                "last_message" => $last_message["message"],
                "date" => $last_message["date"]
            ];
        }



        return $response;
    }

}