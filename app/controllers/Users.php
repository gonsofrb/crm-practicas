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
                            $this->view('pages/user/add');
                            exit();
                        }

                    }else{
                        echo "validacion error";
                        
                        $_SESSION['error_register'] = $errors;

                        $this->view('pages/user/add');
                        exit();
                         }
      


        }else{
            $data = [
                'name'=>'',
                'user'=>'',
                'password'=>'',
                'rol'=>'',
                'company'=>'',
                'email'=>'',
                'telephone'=>'',
                'image'=>''

            ];
            $this->view('pages/user/add');
        }
    }


    //Método para editar un usuario
    public function editUser(){
        if(isset($_GET['id'])){
            $id=$_GET['id'];
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
        }
    }
    //Método para borrar un usuario
    public function deleteUser(){
        if($_SERVER['REQUEST_METHOD'] =='GET'){
            $id_user = $_GET['id'];
            $this->UsersModel->deleteForId($id_user);

            redirect('/Users/see/');
        }
    }



    //Método para guardar un cliente editado
    public function saveUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id=$_POST['edit_user_id'];
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


                        $dit_user = $this->UsersModel->updateUser($data);
                        if($edit_data){
                            $_SESSION['edit_complete'] = "Los datos del usuario han sido actualizados.";


                        }else{
                            array_push($errors,"No se han podido actualizar los datos del usuario.");
                            $_SESSION['error_edit'] = $errors;
                        }




                }else{
                    $_SESSION['error_edit'] = $errors;
                }
        }
    }
}