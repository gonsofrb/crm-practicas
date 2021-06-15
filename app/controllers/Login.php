<?php
     
    class Login extends Controller{
      
     
        public function __construct(){
          $this->LoginModel = $this->model('LoginModel');
          
        }

        public function index(){
          $this->view('/pages/login/login');
        }

        //Método para iniciar sesion
        public function start(){
         
            $user=Controller::clean_characters(ucwords($_POST['user_log']));
            $password_user=Controller::clean_characters($_POST['password_log']);

           
            $errors = array();

                if($user=='' || $password_user==''){
                  array_push($errors,"Debe rellenar los campos.");
                }

            if(count($errors)==0){
                
                $datos=[
                  'user_name'=>$user
                ];
               
                $data_login= $this->LoginModel->checkLogin($datos);
               
                
                 if($data_login->rowCount()==1){
                    $row=$data_login->fetch();
                    $password_db=$row['contrasena'];
                 
                  
          
                  
                    $verify = password_verify($password_user,$password_db);
                 

                        if($verify){
                            session_start();
                            $_SESSION['id_user_crm'] = $row['id_usuario'];
                            $_SESSION['nombre_usu_crm'] = $row['nombre_usu'];
                            $_SESSION['rol_crm']=$row['rol'];
                            $_SESSION['token_crm']=md5(uniqid(mt_rand(),true));//Se procesa por md5 un numero unico para cada sesion
                            echo  $_SESSION['id_user_crm'];
                            echo "<br>";
                            echo  $_SESSION['nombre_usu_crm'];
                            echo "<br>";
                            echo  $_SESSION['rol_crm'];
                            echo "<br>";
                            echo  $_SESSION['token_crm'];
                            
                            header("Location:".PATH_URL."/Tasks/index/");

                        }else{
                          array_push($errors,"La contraseña es incorrecta.");
                          $_SESSION['error_session'] = $errors;
                          $this->view('pages/login/login');
                        }

                }else{
                   array_push($errors,"No existe ese usario en la base de datos.");
                   $_SESSION['error_session'] = $errors;
                   $this->view('pages/login/login');
                }

                
                

            }else{
             
             echo "vacio";
              $_SESSION['error_session'] = $errors;
             // $this->view('pages/login/login');
              redirect('/Login/index/');
            }
        }

        //Método para forzar cierre
        public function close(){
          session_start();
        // unset();
         session_destroy();
         header("Location:".PATH_URL."/Login/index/");

        
         
        }

    }
    