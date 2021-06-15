<?php

//Clase que se conecta a la base de datos
class Conexion{
    
    private $dbh;
    private $stmt;
    private $error;
  
    public static function connect(){

        //configurar conexión
        $dsn = 'mysql:host='.DB_HOST. ';dbname='.DB_NAME;

        $opciones = array(
            PDO::ATTR_PERSISTENT => true, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        //Crear una instancia de PDO
        try {
            $dbh = new PDO($dsn,DB_USER, DB_PASSWORD,$opciones);
            $dbh->exec('set names utf8');

        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo $error;
        }
        return $dbh;

    }


       

}