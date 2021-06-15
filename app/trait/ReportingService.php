<?php

trait Clientbd{

    public function __construct(){
        try {
            $this->db = Conexion::connect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


   
    public function all_customers(){
        $pst = $this->db->query("SELECT id_cliente,logo,nombre_cliente,email,telefono FROM clientes");
        return $data = $pst->fetchAll(PDO::FETCH_OBJ);
    }
}