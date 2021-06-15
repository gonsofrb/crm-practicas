<?php
        //Cargamos las clases
        require_once 'config/parameters.php';
        require_once 'helpers/url_helper.php';

        // require_once 'core/Conexion.php';
        // require_once 'core/Controller.php';
        // require_once 'core/Core.php';
       
        //Autoload php
        spl_autoload_register(function($clase_name){
                require_once 'core/'.$clase_name.'.php';
        });

?>