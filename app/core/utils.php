<?php


class Utils{

    
        //Creamos un método estátitco para borrar una sesion que le pasaremos por parámetro
        public static function deleteSession($name){
        
            //Comprobamos si existe la sesion
            if(isset($_SESSION[$name])){
                $_SESSION[$name] = null;
    
                //Borramos la sesion finalmente
                unset($_SESSION[$name]);
            }
            //Devolvemos el nombre de la sesión borrada
            return $name;
            
        }


}