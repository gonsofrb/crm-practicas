<?php
    //Clase controlador principal
    //Se encarga de poder cargar los modelos y las vista
    class Controller{

        //Función para cargar el modelo
        public function model($model){

                require_once '../app/models/'. $model. '.php';
                //Intancia del modelo
                return new $model();
        }

         //Función para cargar vista
         public function view($view, $data = []){
             //Comprobamos si el archivo vista existe
             if(file_exists('../app/views/'.$view.'.php')){
                require_once '../app/views/'.$view.'.php';
             }else{
                 die('La vista no existe');
             }
           
        }

          /*-------Función  limpiar cadenas--------*/
          protected static function clean_characters($characters){
            $characters=trim($characters);
            $characters=stripslashes($characters);//Limpiar los /
            $characters=str_ireplace("<scrit>", "" ,$characters); //busca script y lo elimina
            $characters=str_ireplace("</scrit>", "" ,$characters); //busca script y lo elimina
            $characters=str_ireplace("<scrit src", "" ,$characters); //busca src y lo elimina
            $characters=str_ireplace("<scrit type=", "" ,$characters); //busca type y lo elimina
            $characters=str_ireplace("SELECT * FROM ", "" ,$characters); //busca select * from y lo elimina
            $characters=str_ireplace("DELETE FROM ", "" ,$characters); //busca DELETE FROM y lo elimina
            $characters=str_ireplace("INSERT INTO", "" ,$characters); //busca INSERT INTO y lo elimina
            $characters=str_ireplace("DROP TABLE ", "" ,$characters); //busca DROP TABLE y lo elimina
            $characters=str_ireplace("DROP DATABASE", "" ,$characters); //busca DROP DATABASE elimina
            $characters=str_ireplace("TRUNCATE TABLE", "" ,$characters); //busca TRUNCATE TABLE y lo elimina
            $characters=str_ireplace("SHOW TABLES", "" ,$characters); //busca SHOW TABLES y lo elimina
            $characters=str_ireplace("SHOW DATABASES", "" ,$characters); //busca SHOW DATABASES y lo elimina
            $characters=str_ireplace("<?php", "" ,$characters); //busca <?php y lo elimina
            $characters=str_ireplace("?>", "" ,$characters); //busca ? > from y lo elimina
            $characters=str_ireplace("--", "" ,$characters); //busca  -- y lo elimina
            $characters=str_ireplace(">", "" ,$characters); //busca  > y lo elimina
            $characters=str_ireplace("<", "" ,$characters); //busca  < y lo elimina
            $characters=str_ireplace("[", "" ,$characters); //busca  [ y lo elimina
            $characters=str_ireplace("]", "" ,$characters); //busca  ] y lo elimina
            $characters=str_ireplace("^", "" ,$characters); //busca  ^ y lo elimina
            $characters=str_ireplace("==", "" ,$characters); //busca  == y lo elimina
            $characters=str_ireplace(";", "" ,$characters); //busca  ; y lo elimina
            $characters=str_ireplace("::", "" ,$characters); //busca  :: y lo elimina
            $characters=stripslashes($characters);
            $characters=trim($characters);
            return $characters;
        }



    }
?>