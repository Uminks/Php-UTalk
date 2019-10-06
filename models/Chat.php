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
                $name = "No Channel";
                $stmt = Conexion::conectar()->prepare("INSERT INTO chats (name, id_user_1, id_user_2) VALUES (:name, :id_user_1, :id_user_2)");
                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":id_user_1", $data["id"], PDO::PARAM_INT);
                $stmt->bindParam(":id_user_2", $data["id_to_user"], PDO::PARAM_INT);
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

        $stmt = Conexion::conectar()->prepare("SELECT c.* FROM $tabla c INNER JOIN users_chat uc ON c.id = uc.id_chat WHERE uc.id_user = :id");
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->execute();
        
        $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $response = array();
        foreach ( $chats as $chat ) {
            $stmt = Conexion::conectar()->prepare("SELECT message, date, viewed FROM messages  WHERE id_chat = :id_chat ORDER BY date DESC");
            $stmt->bindParam(":id_chat", $chat["id"], PDO::PARAM_INT);
            $stmt->execute();

            $last_message = $stmt->fetch(PDO::FETCH_ASSOC);

            if( !$chat["channel"] ) {

                if ( $chat["id_user_1"] !=  $data["id"] ) {
                    $id = $chat["id_user_1"];
                }
                elseif ( $chat["id_user_2"] !=  $data["id"] ) {
                    $id = $chat["id_user_2"];
                }
                
                $stmt = Conexion::conectar()->prepare("SELECT first_name, last_name, connection_status FROM users WHERE id = :id");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $name = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $status = $name["connection_status"];
                $name = $name["first_name"] . ' ' . $name["last_name"];
            }
            else {
                $status = 1;
                $name = $chat["name"];
            }

            $response[] = [
                "id" => $chat["id"],
                "name" => $name,
                "last_message" => $last_message["message"],
                "date" => $last_message["date"],
                "viewed" => $last_message["viewed"],
                "status" => $status
            ];
        }

        return $response;
    }

    public static function getAllMessagesModel ($data, $tabla) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET viewed = 1 WHERE id_chat = :id_chat AND id_user != :id_user");
        $stmt->bindParam(":id_chat", $data["id_chat"], PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_INT);
        $stmt->execute();

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla m INNER JOIN users u ON m.id_user = u.id WHERE m.id_chat = :id_chat");
        $stmt->bindParam(":id_chat", $data["id_chat"], PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function sendMessageModel ($data, $tabla) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO messages (id_user, id_chat, message, date) VALUES (:id_user, :id_chat, :message, :date)");
        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_INT);
        $stmt->bindParam(":id_chat", $data["id_chat"], PDO::PARAM_INT);
        $stmt->bindParam(":message", $data["message"], PDO::PARAM_STR);
        $stmt->bindParam(":date", $data["date"], PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function getNewMessagesModel ($data, $tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla m INNER JOIN users u ON m.id_user = u.id WHERE m.id_chat = :id_chat AND m.id_user != :id_user AND m.viewed = 0");
        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_INT);
        $stmt->bindParam(":id_chat", $data["id_chat"], PDO::PARAM_INT);
        $stmt->execute();

        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET viewed = 1 WHERE id_chat = :id_chat AND id_user != :id_user");
        $stmt->bindParam(":id_chat", $data["id_chat"], PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $data["id_user"], PDO::PARAM_INT);
        $stmt->execute();

        return $response;
    }

}