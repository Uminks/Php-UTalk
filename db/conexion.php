<?php

class Db {

    private $db;
    private $host='localhost';
    private $dbname='utalk_chat';
    private $user='root';
    private $pass='';

    public function getDb(){
        return $this->db;
    }

    public function connectDb(){
        
        try {

            $this->$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            # Para que genere excepciones a la hora de reportar errores.
            $this->$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            return "Conexion Exitosa";

        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function createDb(){

        $this->connectDb();
        $sql = "CREATE DATABASE utalk_chat";

        if($this->db->query($sql)){
            echo "Base de datos creada con éxito.";
        }else {
            echo "Error creando base de datos". $this->db->error;
        }    

    }

}

?>
