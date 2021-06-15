<?php

    class TaskModel{

        private $db;
        private $id;
        private $name;
        private $limit_date;
        private $author;
        private $partner_project;
        private $description;
        private $state;
        private $priority;
        private $duration;
        
       

        public function __construct(){
            try {
                $this->db = Conexion::connect();
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }


        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }
        public function getLimitDate(){
            return $this->limit_date;
        }
        public function getAuthor(){
            return $this->author;
        }
        public function getPartner_project(){
            return $this->partner_project;
        }
        public function getDescription(){
            return $this->description;
        }

        public function getState(){
            return $this->state;
        }

        public function getPriority(){
            return $this->priority;
        }

        public function getDuration(){
           return $this->duration;
       }


        public function setId($id){
            $this->id = $id;
        }

        public function setName($name){
            $this->name = $this->db->real_escape_string($name);
        }

        public function setLimitDate($limit_date){
            $this->limit_date = $this->db->real_escape_string($limit_date);
        }

        public function setAuthor($author){
            $this->author = $this->db->real_escape_string($author);
        }

        public function setParter_project($partner_project){
            $this->partner_project = $this->db->real_escape_string($partner_project);
        }

        public function setDescription($description){
            $this->description = $this->db->real_escape_string($description);
        }

        public function setState($state){
            $this->state = $this->db->real_escape_string($state);
        }

        public function setPriority($priority){
            $this->priority = $this->db->real_escape_string($priority);
        }

        public function setDuration($duration){
            $this->duration = $this->db->real_escape_string($duration);
        }

        

        //?Función tareas pendientes al dia
        public function todays_unfinished_tasks(){
            $pst = $this->db->query("SELECT nombre_tarea,descripcion,estado,prioridad FROM tareas WHERE fecha_limite = CURRENT_DATE()");
            
            return $data = $pst->fetchAll(PDO::FETCH_OBJ);
         
        }

        //?Función tareas pendientes 7 dias
        public function unfinished_tasks(){
            $pst = $this->db->query("SELECT nombre_tarea,descripcion,estado,prioridad FROM tareas WHERE fecha_limite BETWEEN CURDATE() AND CURDATE() + INTERVAL  7 DAY");
            
           return $data = $pst->fetchAll(PDO::FETCH_OBJ);
            
        }

        //Función agregar tareas
        public function add($data){
            $pst = $this->db->prepare("INSERT INTO tareas (nombre_tarea,fecha_limite,autor,proyecto_asociado,descripcion,estado,prioridad,duracion,id_cliente) VALUES (:name,:date_limit,:author,:project,:description,:state,:priority,:duration,:id_client)");
           
            $pst->bindParam(":name",$data['name']);
            $pst->bindParam(":date_limit",$data['date']);
            $pst->bindParam(":author",$data['author']);
            $pst->bindParam(":project",$data['project']);
            $pst->bindParam(":description",$data['description']);
            $pst->bindParam(":state",$data['state']);
            $pst->bindParam(":priority",$data['priority']);
            $pst->bindParam(":duration",$data['duration']);
            $pst->bindParam(":id_client",$data['id_client']);
          

            $pst->execute();
          
            return $pst;
        }

    }

?>