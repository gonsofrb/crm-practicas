<?php

  require_once '../app/models/ProjectsModel.php';
  require_once '../app/models/ClientModel.php';


  

    class Tasks extends Controller{
      
        public function __construct(){
           

          $this->TaskModel = $this->model('TaskModel');
          $this->ProjectsModel = $this->model('ProjectsModel');
          $this->ClientModel = $this->model('ClientModel');

        }

        public function index(){

          $tasksToday = $this->TaskModel->todays_unfinished_tasks();
         
          $clients=$this->ClientModel->all_customers();

          //print_r($clients);
          $tasks = $this->TaskModel->unfinished_tasks();
          
         
          $projects = $this->ProjectsModel->getProjects();

          $data = [

            'tasksToday'=> $tasksToday,
            'tasks'=>$tasks,
            'projects'=>$projects,
            'clients'=>$clients,
            'name'=>'',
            'date'=>'',
            'author'=>'',
            'description'=>'',
            'state'=>'',
            'priority'=>'',
            'duration'=>''
          ];

          $this->view('pages/inicio',$data);

        }

        //Método para agregar tareas
        public function addTasks(){

          if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $errors = array();
               //Limpiamos los valores        
               $name=Controller::clean_characters($_POST['name']);
               $date=Controller::clean_characters($_POST['date']);
               $author=Controller::clean_characters($_POST['author']);
               $project=Controller::clean_characters($_POST['project']);
               $description=Controller::clean_characters($_POST['description']);
               $state=Controller::clean_characters($_POST['state']);
               $priority=Controller::clean_characters($_POST['priority']);
               $duration=Controller::clean_characters($_POST['duration']);
               $client=$_POST['client'];
                

                //Comprobación que los campos no estén vacios
                  if(empty($name) || empty($date) || empty($author) || empty($project) || empty($description)  ||  empty($duration) || empty($client)){
                    array_push($errors,"Debe completar todos los campos.");
                  }

                  //Comprobación por si cambian los valores en el html
                  if($state!='Sin Empezar' && $state!='Comenzada' && $state!='Completada' && $state!='Cancelada'){
                    array_push($errors,"Debe seleccionar un estado correcto.");
                  }
                
                  //Comprobación por si cambian los valores en el html
                  if($priority!='Baja' && $priority!='Normal' && $priority!='Alta' && $priority!='Urgente'){
                    array_push($errors,"Debe seleccionar una prioridad correcta.");
                  }

                  //Validación campo duración
                  if(is_string($duration) && preg_match("/[a-zA-Z]/",$duration)){
                    array_push($errors, "Debe poner un formato correcto de la duración.");
                  }

                  if(count($errors) == 0 ){

                    $date=date("Y-m-d",strtotime($date));

                    $data = [
                      'name'=>$name,
                      'date'=>$date,
                      'author'=>$author,
                      'project'=>$project,
                      'description'=>$description,
                      'state'=>$state,
                      'priority'=>$priority,
                      'duration'=>$duration,
                      'id_client'=>$client
                      
  
                    ];
  
                    
                    $new_task = $this->TaskModel->add($data);
                    
                        redirect('/Tasks/index/');
                        //echo "bandera1";

                      }else{

                        //!Mirar la redirección
                        $_SESSION['error_register'] = $errors;

                        $tasksToday = $this->TaskModel->todays_unfinished_tasks();
         
                        $clients=$this->ClientModel->all_customers();
              
                        //print_r($clients);
                        $tasks = $this->TaskModel->unfinished_tasks();
                        
                       
                        $projects = $this->ProjectsModel->getProjects();


                        $data = [
                          'tasksToday'=> $tasksToday,
                          'tasks'=>$tasks,
                          'projects'=>$projects,
                          'clients'=>$clients,
                          'name'=>$name,
                          'date'=>$date,
                          'author'=>$author,
                          'project'=>$project,
                          'description'=>$description,
                          'state'=>$state,
                          'priority'=>$priority,
                          'duration'=>$duration,
                          'id_client'=>$client
                          
      
                        ];
                        $this->view('pages/inicio',$data);
                        
                }
                
                
                
                
              }

                 

                
            }
            
          
       }
       

        
    
    

    
?>