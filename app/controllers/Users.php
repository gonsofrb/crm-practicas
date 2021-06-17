<?php

class Users extends Controller{
    public function __construct(){
        $this->UsersModel = $this->model('UserModel');
    }

    public function index(){
        $this->see();
    }

    //Método para ver todos los usuarios
    public function see(){
        $users = $this->UsersModel->all_users();

        $data = [
            'users'=> $users
        ];

        $this->view('/pages/user/see',$data);
    }

    //Método para crear un usuario
    public function addUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $errors = array();

            
                         
            if(isset($_FILES['image'])){
                $file = $_FILES['image'];
                $name_file = $file['name'];
                $mimetype = $file['type'];
                $size_file = $file['size'];

                    //Comprobamos que la imagen tenga como maximo 3mb de tamaño
                if($size_file<=3000000){

                    //Comprobamos que la imagen tenga como extensión  jpg, jpeg, png o gif.
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                        //Si no exite el directorio /img_client, se crea para ir guardando las imagenes.
                        if(!is_dir('./img_user/')){
                            mkdir('./img_user/',0777,true);
                        }

                        //con move_uploaded_files, le indicamos que vaya guardando las imagenes que están en los archivos temporales en el directorio /img_client y que le ponga de nombre lo que recibe por la variable $name_file.

                        move_uploaded_file($file['tmp_name'],'./img_user/'.$name_file);

                        

                        }
                    }
            
                }

                //Limpiamos lo campos
                $image=$name_file;
                $name=Controller::clean_characters(ucwords($_POST['name']));
                $user=Controller::clean_characters(ucwords($_POST['user']));
                $password=Controller::clean_characters($_POST['password']);
                $rol=Controller::clean_characters($_POST['rol']);
                $company=Controller::clean_characters($_POST['company']);
                $email=Controller::clean_characters($_POST['email']);
                $telephone=Controller::clean_characters($_POST['telephone']);

               
               //Comprobamos que los campos no vengan vacios.
               if(empty($name) || empty($user) || empty($password) || empty($rol) || empty($company) || empty($email) || empty($telephone)){
                array_push($errors, "Debe rellenar todos los campos obligatorios, por favor.");
                }

                //Comprobamos que no exista el usuario en la BD
                $check_user = $this->UsersModel->simple_query("SELECT nombre_usu FROM usuarios WHERE nombre_usu='$user'");
                if($check_user->rowCount()>0){
                    array_push($errors,"El usuario ya se encuentra registrado en el sistema.");
                }

                //Comprobamos que no exista el email en la BD
                $check_email = $this->UsersModel->simple_query("SELECT email FROM usuarios WHERE email='$email'");
                if($check_email->rowCount()>0){
                    array_push($errors,"El email ya se encuentra registrado en el sistema.");
                }

                //Validación campo email
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    array_push($errors,"El correo no es válido.");
                  }
                 //Validación campo telefono
                if(!preg_match("/\+?\d$/",$telephone)){
                    array_push($errors,"El formato del telefono no es valido.");
                  }
                  $password_segura = password_hash($password,PASSWORD_BCRYPT,['cost' =>4]);


                if(count($errors) == 0){

                    $data= [
                        'name'=>$name,
                        'user'=>$user,
                        'password'=>$password_segura,
                        'rol'=>$rol,
                        'company'=>$company,
                        'email'=>$email,
                        'telephone'=>$telephone,
                        'image'=>$name_file 
                    ];

                    $new_user=$this->UsersModel->add($data);

                        if($new_user->rowCount()==1){
                            $_SESSION['register_complete']="Registro de usuario completado.";
                            $this->view('pages/user/add',$data);
                            exit();
                        }

                    }else{
                        
                        
                        $_SESSION['error_register'] = $errors;

                        $data= [
                            'name'=>$name,
                            'user'=>$user,
                            'password'=>$password_segura,
                            'rol'=>$rol,
                            'company'=>$company,
                            'email'=>$email,
                            'telephone'=>$telephone,
                            'image'=>$name_file 
                        ];

                        $this->view('pages/user/add',$data);
                        exit();
                         }
      


        }else{
            
            $this->view('pages/user/add',$data=null);
        }
    }


    //Método para editar un usuario
    public function editUser(){
        if(isset($_GET['i'])){
            $id=Controller::descryption($_GET['i']);
            
        $errors = array();
            //Comprobación de usuario en la BD
            $check_user= $this->UsersModel->simple_query("SELECT * FROM usuarios WHERE id_usuario='$id'");
            if($check_user->rowCount()>0){
                $user = $this->UsersModel->userForId($id);
                     $data = [
                        'id'=>$id,
                        'name'=>$user->nombre,
                        'user'=>$user->nombre_usu,
                        'rol'=>$user->rol,
                        'company'=>$user->empresa,
                        'email'=>$user->email,
                        'telephone'=>$user->telefono,
                        'image'=>$user->imagen
                    ];

                    $this->view('pages/user/edit',$data);
                   

                }else{
                   // array_push($errors,"Usuario no encontrado.");
                    redirect('/Users/see/');
                     
                }
                
                   
                
                   
        }else{
            redirect('/Users/see/');
        }
    }
    //Método para borrar un usuario
    public function deleteUser(){
        if($_SERVER['REQUEST_METHOD'] =='GET'){
            $id_user = Controller::descryption($_GET['i']);
            $this->UsersModel->deleteForId($id_user);

            redirect('/Users/see/');
        }
    }



    //Método para guardar un usuario editado
    public function saveUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id=$_POST['edit_user_id'];
            $errors = array();

           
            //Comprobar el usuario en la BD
            $check_user= $this->UsersModel->simple_query("SELECT * FROM usuarios WHERE id_usuario='$id' LIMIT 1 ");

         if($check_user->rowCount()<0){
                array_push($errors,"El usuario no se encuentra en el sistema.");
         }else{
            
             $field=$check_user->fetch(PDO::FETCH_ASSOC);
         }

            if(isset($_FILES['image'])){
                $file = $_FILES['image'];
                $name_file = $file['name'];
                $mimetype = $file['type'];
                $size_file = $file['size'];

                    //Comprobamos que la imagen tenga como maximo 3mb de tamaño
                if($size_file<=3000000){

                    //Comprobamos que la imagen tenga como extensión  jpg, jpeg, png o gif.
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                        //Si no exite el directorio /img_client, se crea para ir guardando las imagenes.
                        if(!is_dir('./img_user/')){
                            mkdir('./img_user/',0777,true);
                        }

                        //con move_uploaded_files, le indicamos que vaya guardando las imagenes que están en los archivos temporales en el directorio /img_client y que le ponga de nombre lo que recibe por la variable $name_file.

                        move_uploaded_file($file['tmp_name'],'./img_user/'.$name_file);

                        

                        }
                    }
            
                }



                //Limpiamos los valores
                        
                $name=Controller::clean_characters($_POST['name']);
                $user=Controller::clean_characters($_POST['user']);
                $rol=Controller::clean_characters($_POST['rol']);
                $company=Controller::clean_characters($_POST['company']);
                $email=Controller::clean_characters($_POST['email']);
                $telephone=Controller::clean_characters($_POST['telephone']);
                $image=$name_file; 

                //Comprobamos que los campos no vengan vacios.
                if(empty($name) || empty($user) || empty($rol) || empty($company) || empty($email) || empty($telephone)){
                    array_push($errors, "Debe rellenar todos los campos obligatorios, por favor.");
                }


                if($user!=$field['nombre_usu']){
                    
                    $check_user=$this->UsersModel->simple_query("SELECT nombre_usu FROM usuarios WHERE nombre_usu='$user'");
                    if($check_user->rowCount()>0){
                        array_push($errors, "El nombre de usuario ya se encuentra registrado.");
                    }

                }

                if($email!=$field['email']){
                    $check_email=$this->UsersModel->simple_query("SELECT email FROM usuarios WHERE email='$email'");
                    if($check_email->rowCount()>0){
                        array_push($errors, "El email ya se encuentra registrado.");
                    }

                }


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
                            'name' =>$name,
                            'user' =>$user,
                            'rol' =>$rol,
                            'company' =>$company,
                            'email' =>$email,
                            'telephone' =>$telephone,
                            'image' =>$name_file
            
                        ];


                        $edit_user = $this->UsersModel->updateUser($data);
                        if($edit_user){
                            $_SESSION['edit_complete'] = "Los datos del usuario han sido actualizados.";

                                $this->view('pages/user/edit',$data);

                        }else{
                            array_push($errors,"No se han podido actualizar los datos del usuario.");
                            $_SESSION['error_edit'] = $errors;
                            $this->view('pages/user/edit',$data=null);
                        }




                }else{
                    $_SESSION['error_edit'] = $errors;

                    $data = [
                        'id'=>$id,
                        'name' =>$name,
                        'user' =>$user,
                        'rol' =>$rol,
                        'company' =>$company,
                        'email' =>$email,
                        'telephone' =>$telephone,
                        'image' =>$name_file
        
                    ];

                    $this->view('pages/user/edit',$data);
                }
        }
    }
}