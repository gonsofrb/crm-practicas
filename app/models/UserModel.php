<?php

class UserModel{

    private $db;
    private $id_user;
    private $name_user;
    private $password;
    private $rol;
    private $company;
    private $email;
    private $telephone;
    private $img;


    public function __construct(){
        try {
            $this->db = Conexion::connect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    //Función para obtener todos los usuarios
    public function all_users(){
        $pst = $this->db->query("SELECT * FROM usuarios");
         return $data= $pst->fetchAll(PDO::FETCH_OBJ);

    }

    //Función para guardar un usuario
    public function add($data){
        $pst = $this->db->prepare("INSERT INTO usuarios(nombre,nombre_usu,contrasena,rol,empresa,email,telefono,imagen) VALUES(:name,:user,:password,:rol,:company,:email,:telephone,:image)");
        $pst->bindParam(":name",$data['name']);
        $pst->bindParam(":user",$data['user']);
        $pst->bindParam(":password",$data['password']);
        $pst->bindParam(":rol",$data['rol']);
        $pst->bindParam(":company",$data['company']);
        $pst->bindParam(":email",$data['email']);
        $pst->bindParam(":telephone",$data['telephone']);
        $pst->bindParam(":image",$data['image']);

        $pst->execute();
        return $pst;
    }

    //Método para obtener un usuario por id
    public function userForId($id){
        $pst = $this->db->prepare("SELECT * FROM usuarios WHERE  id_usuario =:id");
        $pst->bindParam(":id",$id);
        $pst->execute();
        $result=$pst->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    //Función para actulizar un usuario
    public function updateUser($data){
        $pst = $this->db->prepare("UPDATE usuarios SET nombre=:name,nombre_usu=:user,rol=:rol,empresa=:company,email=:email,telefono=:telephone,imagen=:image  WHERE id_usuario=:id");

        $pst->bindParam(":name",$data['name']);
        $pst->bindParam(":user",$data['user']);
        $pst->bindParam(":rol",$data['rol']);
        $pst->bindParam(":company",$data['company']);
        $pst->bindParam(":email",$data['email']);
        $pst->bindParam(":telephone",$data['telephone']);
        $pst->bindParam(":image",$data['image']);
        $pst->bindParam(":id",$data['id']);

        $pst->execute();
        return $pst;

    }

    //Función para borrar un usuario
    public function deleteForId($id_user){
        $pst = $this->db->prepare("DELETE FROM usuarios WHERE id_usuario = :id_user");
        $pst->bindParam(":id_user",$id_user);
        $pst->execute();
    }

      //Consulta simple
      public function simple_query($sql){
        $pst = $this->db->query($sql);
        $pst->execute();
       
        return $pst;
    }

}