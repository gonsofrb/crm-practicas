<?php


class ClientModel{

   

    private $db;
    private $id_client;
    private $logo;
    private $name;
    private $cif;
    private $address;
    private $contry;
    private $email;
    private $telephone;
    private $contact_person;
    private $notes;
    private $website;

    public function __construct(){
        try {
            $this->db = Conexion::connect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function getIdClient(){
        return $this->id_client;
    }

    public function getLogo(){
        return $this->logo;
    }

    public function getName(){
        return $this->name;
    }

    public function getCif(){
        return $this->cif;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getCountry(){
        return $this->country;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function getContactPerson(){
        return $this->contact_person;
    }

    public function getNotes(){
        return $this->notes;
    }

    public function getWebsite(){
        return $this->website;
    }

    public function setIdClient($id_client){
        $this->id_client = $id_client;
    }

    public function setLogo($logo){
        $this->logo = $logo;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setCif($cif){
        $this->cif = $cif;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function setCountry($country){
        $this->country = $country;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function setContact_person($contact_person){
        $this->contact_person = $contact_person;
    }

    public function setNotes($notes){
        $this->notes = $notes;
    }

    public function setWebsite($website){
        $this->website =$website;
    }

    //Función para obtener todos los clientes
    public function all_customers(){
        $pst = $this->db->query("SELECT id_cliente,logo,nombre_cliente,email,telefono FROM clientes");
        return $data = $pst->fetchAll(PDO::FETCH_OBJ);
    }

    //Función para obtener un cliente por su id
    public function clientForId($id_client){
        $pst = $this->db->prepare("SELECT * FROM clientes WHERE id_cliente = :id_cliente");
        $data = array("id_cliente" => $id_client);
        // $pst->bindParam(":id_cliente",{$this->getIdClient()},PDO::PARAM_INT);
        $pst->execute($data);
        $result = $pst->fetch(PDO::FETCH_OBJ);
        return $result;
       
    }

    //Función para agregar un cliente
    public function add($data){
        $pst = $this->db->prepare("INSERT INTO clientes VALUES (null,:logo,:nombre,:cif,:direccion,:pais,:email,:telefono,:persona_contacto,:notas,:web,CURRENT_TIMESTAMP())");
       
        $pst->bindParam(":logo",$data['logo'],PDO::PARAM_STR);
        $pst->bindParam(":nombre",$data['name'],PDO::PARAM_STR);
        $pst->bindParam(":cif",$data['cif'],PDO::PARAM_STR);
        $pst->bindParam(":direccion",$data['address'],PDO::PARAM_STR);
        $pst->bindParam(":pais",$data['country'],PDO::PARAM_STR);
        $pst->bindParam(":email",$data['email'],PDO::PARAM_STR);
        $pst->bindParam(":telefono",$data['telephone'],PDO::PARAM_INT);
        $pst->bindParam(":persona_contacto",$data['contact_person'],PDO::PARAM_STR);
        $pst->bindParam(":notas",$data['notes'],PDO::PARAM_STR);
        $pst->bindParam(":web",$data['website'],PDO::PARAM_STR);
      
        $pst->execute();
        return $pst;
    }

    //Función para borrar un cliente
    public function deleteForId($id_client){
        $pst = $this->db->prepare("DELETE  FROM clientes WHERE  id_cliente = :id_cliente");
        $pst->execute(array(":id_cliente" => $id_client));
 
    }

    //Función para actualizar un cliente
    public function updateClient($data){
        $pst = $this->db->prepare("UPDATE clientes SET logo=:logo,nombre_cliente=:name,cif=:cif,direccion=:address, pais=:country,email=:email,telefono=:telephone,persona_contacto=:contact_person,notas=:notes,web=:website WHERE id_cliente=:id_client");

        
        $pst->bindParam(":logo",$data['logo'],PDO::PARAM_STR);
        $pst->bindParam(":name",$data['name'],PDO::PARAM_STR);
        $pst->bindParam(":cif",$data['cif'],PDO::PARAM_STR);
        $pst->bindParam(":address",$data['address'],PDO::PARAM_STR);
        $pst->bindParam(":country",$data['country'],PDO::PARAM_STR);
        $pst->bindParam(":email",$data['email'],PDO::PARAM_STR);
        $pst->bindParam(":telephone",$data['telephone'],PDO::PARAM_INT);
        $pst->bindParam(":contact_person",$data['contact_person'],PDO::PARAM_STR);
        $pst->bindParam(":notes",$data['notes'],PDO::PARAM_STR);
        $pst->bindParam(":website",$data['website'],PDO::PARAM_STR);
        $pst->bindParam(":id_client",$data['id'],PDO::PARAM_STR);

        $pst->execute();

        return $pst;
        
    }
}


?>