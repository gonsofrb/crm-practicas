<?php


class LoginModel{
    
    private $db;
    private $user;
    private $password;


    public function __construct(){
        try {
            $this->db=Conexion::connect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //Función para iniciar sesion
    public function checkLogin($datos){
        $pst=$this->db->prepare("SELECT * FROM usuarios where nombre_usu = :user_name LIMIT 1");
        $pst->bindParam(":user_name",$datos['user_name']);
        $pst->execute();
        return $pst;
    }
}