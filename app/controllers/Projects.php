<?php
     require_once '../app/models/ClientModel.php';
     require_once '../app/controllers/Login.php';
   
    class Projects extends Controller{
      
     
        public function __construct(){
          $this->ProjectsModel = $this->model('ProjectsModel');
          $this->ClientModel = $this->model('ClientModel');
        }

        public function index(){
          $this->see();
        }

        //Método para obtener todos los proyectos
        public function see(){
                                            
          $projects = $this->ProjectsModel->getProjects();
         
          $data = [

            'projects'=>$projects
          ];

          $this->view('pages/project/see',$data);

        }

        //Método para crear un proyecto
        public function addProject(){
          
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $errors = array();
                       
              //Limpiamos los valores         
              $name=Controller::clean_characters($_POST['name']);
              $description=Controller::clean_characters($_POST['description']);
              $state=Controller::clean_characters($_POST['state']);
              $associated_task=Controller::clean_characters($_POST['associated_task']);
              $associated_note=Controller::clean_characters($_POST['associated_note']);
              $client=Controller::clean_characters($_POST['client']);
              
         // print_r($_POST);
              //Comprobamos que los campos no vengan vacios.
              if(empty($name) || empty($description) || empty($associated_task) || empty($associated_note) || empty($client)){
                  array_push($errors, "Debe rellenar todos los campos obligatorios, por favor.");
              }

              if($state!="Sin Empezar" && $state!="Comenzado" &&$state!="Completado" && $state!="Cancelado" ){
                array_push($errors,"Debe seleccionar un estado correcto.");

              }

                if(count($errors) == 0){

                  $data = [
                     
                    'name' =>$name,
                    'description' =>$description,
                    'state' =>$state,
                    'associated_task' =>$associated_task,
                    'associated_note'=>$associated_note,
                    'id_client'=>$client
                     
                          ];

                     $new_project = $this->ProjectsModel->add($data);

                     if($new_project->rowCount()==1){

                          $_SESSION['register_complete']="Registro de proyecto completado.";

                          $this->view('pages/project/add',$data=null);
                          
                     }
      
                
                }else{
                   
                  $_SESSION['error_register'] = $errors;
                   $clients= $this->ClientModel->all_customers();
                  

                  $data = [
                     
                    'name'=>$name,
                    'description'=>$description,
                    'state' =>$state,
                    'associated_task'=>$associated_task,
                    'associated_note'=>$associated_note,
                    'clients'=>$clients
                     
                          ];

                  $this->view('pages/project/add',$data);
                }

          }else{
            $clients= $this->ClientModel->all_customers();
              
            $data = [
              'name'=>'',
              'description'=>'',
              'state' =>'',
              'associated_task'=>'',
              'associated_note'=>'',
              'clients'=> $clients
                    ];
                    
            $this->view('pages/project/add',$data);
                    
              }
              
         

      }


      //Método para borrar un proyecto
      public function deleteProject(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
          $id_project= Controller::descryption($_GET['i']);

          $this->ProjectsModel->deleteForId($id_project);

          redirect('/Projects/see/');

                }
      }


      //Método para editar un proyecto
      public function editProject(){
        if(isset($_GET['id'])){
          $id_project = Controller::descryption($_GET['id']);
          $project = $this->ProjectsModel->projectForId($id_project);
          $client= $this->ClientModel->all_customers();
          
          $data = [
            'id_project'=>$id_project,
            'name'=>$project->nombre_proyecto,
            'description'=>$project->descripcion,
            'state'=>$project->estado,
            'associated_task'=>$project->tarea_asociada,
            'associated_note'=>$project->nota_asociada,
            'id_client'=>$project->id_cliente,
            'clients'=>$client

          ];
          
          $this->view('pages/project/edit',$data);
              }
      }

      


      //Método para guardar un proyecto editado
      public function saveProject(){
  
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          $id_project = $_POST['edit_project_id'];
            $errors = array();
                      
            //Limpiamos los valores         
            $name=Controller::clean_characters($_POST['name']);
            $description=Controller::clean_characters($_POST['description']);
            $state=Controller::clean_characters($_POST['state']);
            $associated_task=Controller::clean_characters($_POST['associated_task']);
            $associated_note=Controller::clean_characters($_POST['associated_note']);
            $client=Controller::clean_characters($_POST['client']);
            
        // print_r($_POST);
            //Comprobamos que los campos no vengan vacios.
            if(empty($name) || empty($description) || empty($associated_task) || empty($associated_note) || empty($client)){
              array_push($errors, "Debe rellenar todos los campos obligatorios, por favor.");
              }

            if($state!="Sin Empezar" && $state!="Comenzado" &&$state!="Completado" && $state!="Cancelado" ){
              array_push($errors,"Debe seleccionar un estado correcto.");

            }

              if(count($errors) == 0){

                $data = [
                  'id_project'=>$id_project,
                  'name' =>$name,
                  'description' =>$description,
                  'state' =>$state,
                  'associated_task' =>$associated_task,
                  'associated_note'=>$associated_note,
                  'id_client'=>$client
                    
                        ];

                    $edit_project = $this->ProjectsModel->updateProject($data);

                    if($edit_project->rowCount()==1){

                        $_SESSION['edit_complete']="Los datos del proyecto han sido actualizados.";

                        $this->view('pages/project/edit',$data=null);
                        
                    }else{
                      array_push($errors,"No se han podido actualizar los datos del proyecto.");
                      $_SESSION['error_edit'] = $errors;
                      $this->view('pages/project/edit',$data=null);
                    }
    
              
              }else{
                 
                $_SESSION['error_edit'] = $errors;
                $client= $this->ClientModel->all_customers();


                $data = [
                  'id_project'=>$id_project,
                  'name' =>$name,
                  'description' =>$description,
                  'state' =>$state,
                  'associated_task' =>$associated_task,
                  'associated_note'=>$associated_note,
                  'clients'=>$client
                    
                        ];


               
                $this->view('pages/project/edit',$data);
              }

        }


        
    
       }

  }
    
?>