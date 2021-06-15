<?php

class ProjectsModel{

    private $db;
    private $id_project;
    private $name;
    private $description;
    private $state;
    private $associated_task;
    private $associated_note;

    public function __construct(){
        try {
            $this->db = Conexion::connect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //Función para obtener todos los proyectos
    public function getProjects(){
    $pst = $this->db->query("SELECT c.nombre_cliente,p.* FROM clientes c INNER JOIN proyectos p WHERE c.id_cliente=p.id_cliente");
 
    
        return $data = $pst->fetchAll(PDO::FETCH_OBJ);
    }

     //Función para agregar un proyecto
     public function add($data){
        $pst = $this->db->prepare("INSERT INTO proyectos(nombre_proyecto,descripcion,estado,tarea_asociada,nota_asociada,id_cliente) VALUES (:name,:description,:state,:associated_task,:associated_note,:client)");
       
        $pst->bindParam(":name",$data['name'],PDO::PARAM_STR);

        $pst->bindParam(":description",$data['description'],PDO::PARAM_STR);

        $pst->bindParam(":state",$data['state'],PDO::PARAM_STR);

        $pst->bindParam(":associated_task",$data['associated_task'],PDO::PARAM_STR);

        $pst->bindParam(":associated_note",$data['associated_note'],PDO::PARAM_STR);

        $pst->bindParam(":client",$data['id_client'],PDO::PARAM_STR);
        
      
        $pst->execute();
        return $pst;
    }

    //Función para borrar un proyecto
    public function deleteForId($id_project){
        $pst = $this->db->prepare("DELETE FROM proyectos WHERE id_proyecto = :id_project");
        $pst->bindParam(":id_project",$id_project);
        $pst->execute();

        return $pst;

    }

    //Función para obtener un proyecto
    public function projectForId($id_project){
        $pst = $this->db->prepare("SELECT * FROM proyectos WHERE id_proyecto=:id_project");
        $pst->bindParam(":id_project",$id_project);
        $pst->execute();
         return $data = $pst->fetch(PDO::FETCH_OBJ);
    }

    //Función para actualizar un  proyecto
    public function updateProject($data){
        $pst = $this->db->prepare("UPDATE proyectos SET nombre_proyecto=:name_project,descripcion=:description,estado=:state,tarea_asociada=:associated_task, nota_asociada=:associated_note,id_cliente=:id_client  WHERE id_proyecto=:id_project");

        
        $pst->bindParam(":name_project",$data['name'],PDO::PARAM_STR);
        $pst->bindParam(":description",$data['description'],PDO::PARAM_STR);
        $pst->bindParam(":state",$data['state'],PDO::PARAM_STR);
        $pst->bindParam(":associated_task",$data['associated_task'],PDO::PARAM_STR);
        $pst->bindParam(":associated_note",$data['associated_note'],PDO::PARAM_STR);
        $pst->bindParam(":id_client",$data['id_client'],PDO::PARAM_STR);
        $pst->bindParam(":id_project",$data['id_project'],PDO::PARAM_INT);
        

        $pst->execute();

        return $pst;
        
    }


}
