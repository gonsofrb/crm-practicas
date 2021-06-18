<?php
     
    class Clients extends Controller{
         
    

        public function __construct(){
            
            $this->ClientModel = $this->model('ClientModel');
        }

        public function index(){
            $this->see();
        }

        //Método para ver todos los clientes
        public function see(){
            // $clients = new Clients();
            // $clients->all_customers();
           
            $clients= $this->ClientModel->all_customers();
            // print_r($clients);
            // die();
            $data = [
                    'clients'=> $clients
            ];

        
            $this->view('/pages/client/see',$data);

        }

        //Método para crear un cliente
        public function addClient(){
          
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $errors = array();
                         
                    if(isset($_FILES['logo'])){
                        $file = $_FILES['logo'];
                        $name_file = $file['name'];
                        $mimetype = $file['type'];
                        $size_file = $file['size'];

                            //Comprobamos que la imagen tenga como maximo 3mb de tamaño
                        if($size_file<=3000000){

                            //Comprobamos que la imagen tenga como extensión  jpg, jpeg, png o gif.
                            if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                                //Si no exite el directorio /img_client, se crea para ir guardando las imagenes.
                                if(!is_dir('./img_client/')){
                                    mkdir('./img_client/',0777,true);
                                }

                                //con move_uploaded_files, le indicamos que vaya guardando las imagenes que están en los archivos temporales en el directorio /img_client y que le ponga de nombre lo que recibe por la variable $name_file.

                                move_uploaded_file($file['tmp_name'],'./img_client/'.$name_file);

                                

                                }
                            }
                    
                        }

                //Limpiamos los valores
                $logo=$name_file;          
                $name=Controller::clean_characters($_POST['name']);
                $cif=Controller::clean_characters($_POST['cif']);
                $address=Controller::clean_characters($_POST['address']);
                $country=Controller::clean_characters($_POST['country']);
                $email=Controller::clean_characters($_POST['email']);
                $telephone=Controller::clean_characters($_POST['telephone']);
                $contact_person=Controller::clean_characters($_POST['contact_person']);
                $notes=Controller::clean_characters($_POST['notes']);
                $website=Controller::clean_characters($_POST['website']);

              //print_r($_POST);
                //Comprobamos que los campos no vengan vacios.
                if(empty($name) || empty($cif) || empty($address) || empty($country) || empty($email) || empty($telephone) || empty($contact_person) || empty($notes) || empty($website)){
                    array_push($errors, "Debe rellenar todos los campos obligatorios, por favor.");
                }

                // //!Validación campo cif mirar
                // if(preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)){
                //     if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)){
                //       return true;
                //     }else{
                //       array_push($errors,"Debe escribir un cif válido");
                //     }
                //   }

                  //Validación campo email
                  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    array_push($errors,"El correo no es válido.");
                  }

                  //Validación campo telefono
                  if(!preg_match("/\+?\d$/",$telephone)){
                    array_push($errors,"El formato del telefono no es valido.");
                  }
                  

                  if(count($errors) == 0){

                    $data = [
               
                        'logo' =>$name_file,
                        'name' =>$name,
                        'cif' =>$cif,
                        'address' =>$address,
                        'country' =>$country,
                        'email' =>$email,
                        'telephone' =>$telephone,
                        'contact_person' =>$contact_person,
                        'notes' =>$notes,
                        'website' =>$website
         
                       ];
                       
                       $new_client = $this->ClientModel->add($data);

                       if($new_client->rowCount()==1){
                      
                          
                             $_SESSION['register_complete']="Registro completado.";
                            //  $fichero = fopen("otro.txt","w");

                            //  fwrite($fichero,"Esto es una prueba");
                         
                            //  fclose($fichero);

                            
                            $this->view('pages/client/add',$data=null);
                            exit();
                            
                       }
        
                  
                  }else{
                      
                    
                    $_SESSION['error_register'] = $errors;
                    $data = [
               
                        'logo' =>$name_file,
                        'name' =>$name,
                        'cif' =>$cif,
                        'address' =>$address,
                        'country' =>$country,
                        'email' =>$email,
                        'telephone' =>$telephone,
                        'contact_person' =>$contact_person,
                        'notes' =>$notes,
                        'website' =>$website
         
                       ];

                    $this->view('pages/client/add',$data);
                    exit();
                  }

            }else{
                    //echo "validacion2";
            $this->view('pages/client/add',$data=null);
            exit();
            
                }
            ;
           

        }

       //Método para borrar un cliente
        public function deleteClient(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){

                $id_client = Controller::descryption($_GET['i']);
               
                $this->ClientModel->deleteForId($id_client);

                redirect('/Clients/see/');

            }
        }
        
        //Método para editar un cliente
        public function editClient(){
           if(isset($_GET['id'])){
               $id=Controller::descryption($_GET['id']);
              $client = $this->ClientModel->clientForId($id);

             // print_r($client);

              $data = [
                
                'id'=>$id,
                'logo' =>$client->logo,
                'name' =>$client->nombre_cliente,
                'cif' =>$client->cif,
                'address' =>$client->direccion,
                'country'=>$client->pais,
                'email'=>$client->email,
                'telephone'=>$client->telefono,
                'contact_person'=>$client->persona_contacto,
                'notes'=>$client->notas,
                'website'=>$client->web 
                     ];

                     $this->view('pages/client/edit',$data);    
    
           }
           
        }

        //Método para guardar un cliente editado
        public function saveClient(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
                $id=$_POST['edit_client_id'];
               
                $errors = array();
                         
                    if(isset($_FILES['logo'])){
                        $file = $_FILES['logo'];
                        $name_file = $file['name'];
                        $mimetype = $file['type'];
                        $size_file = $file['size'];

                            //Comprobamos que la imagen tenga como maximo 3mb de tamaño
                        if($size_file<=3000000){

                            //Comprobamos que la imagen tenga como extensión  jpg, jpeg, png o gif.
                            if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                                //Si no exite el directorio /img_client, se crea para ir guardando las imagenes.
                                if(!is_dir('./img_client/')){
                                    mkdir('./img_client/',0777,true);
                                }

                                //con move_uploaded_files, le indicamos que vaya guardando las imagenes que están en los archivos temporales en el directorio /img_client y que le ponga de nombre lo que recibe por la variable $name_file.

                                move_uploaded_file($file['tmp_name'],'./img_client/'.$name_file);

                                

                                }
                            }
                    
                        }
                       
                //Limpiamos los valores
                $logo=$name_file;          
                $name=Controller::clean_characters($_POST['name']);
                $cif=Controller::clean_characters($_POST['cif']);
                $address=Controller::clean_characters($_POST['address']);
                $country=Controller::clean_characters($_POST['country']);
                $email=Controller::clean_characters($_POST['email']);
                $telephone=Controller::clean_characters($_POST['telephone']);
                $contact_person=Controller::clean_characters($_POST['contact_person']);
                $notes=Controller::clean_characters($_POST['notes']);
                $website=Controller::clean_characters($_POST['website']);
                        
              //print_r($_POST);
                //Comprobamos que los campos no vengan vacios.
                if(empty($name) || empty($cif) || empty($address) || empty($country) || empty($email) || empty($telephone) || empty($contact_person) || empty($notes) || empty($website)){
                    array_push($errors, "Debe rellenar todos los campos obligatorios, por favor.");
                }
                  
                // //!Validación campo cif mirar
                // if(preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)){
                //     if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)){
                //       return true;
                //     }else{
                //       array_push($errors,"Debe escribir un cif válido");
                //     }
                //   }

                  //Validación campo email
                  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    array_push($errors,"El correo no es válido.");
                  }

                  //Validación campo telefono
                  if(!preg_match("/\+?\d$/",$telephone)){
                    array_push($errors,"El formato del telefono no es valido.");
                  }
                  
                 
                  if(count($errors) == 0){
                   
                    $data = [
                        'id'=>$id,
                        'logo' =>$name_file,
                        'name' =>$name,
                        'cif' =>$cif,
                        'address' =>$address,
                        'country' =>$country,
                        'email' =>$email,
                        'telephone' =>$telephone,
                        'contact_person' =>$contact_person,
                        'notes' =>$notes,
                        'website' =>$website
         
                       ];
                       
                       $edit_client = $this->ClientModel->updateClient($data);
                       if($edit_client){
                           
                            $_SESSION['edit_complete'] = "Los datos  del cliente han sido actualizados.";
                            $this->view('pages/client/edit',$data=null);
                       }else{
                           array_push($errors,"No se han podido actualizar los datos del cliente, intentelo de nuevo.");
                           $_SESSION['error_edit'] = $errors;
                           $this->view('pages/client/edit',$data=null);
                       }
        
                  
                  }else{
                    
                    $_SESSION['error_edit'] = $errors;

                    $data = [
                        'id'=>$id,
                        'logo' =>$name_file,
                        'name' =>$name,
                        'cif' =>$cif,
                        'address' =>$address,
                        'country' =>$country,
                        'email' =>$email,
                        'telephone' =>$telephone,
                        'contact_person' =>$contact_person,
                        'notes' =>$notes,
                        'website' =>$website
         
                       ];

                    $this->view('pages/client/edit',$data);
                    }

                    

                }

              
       
            }
   
   
        }



?>