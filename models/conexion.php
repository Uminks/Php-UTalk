<?php 

class Conexion{
    
    public static function conectar(){

        #3 parametros para conectarse a una base de datos con PDO (host;DBname, user, password)
        $link = new PDO("mysql:host=localhost;dbname=utalk_chat","root","");
        return $link;
    }
}
