<?php

//Ruta de la aplicación
define('PATH_APP', dirname(dirname(__FILE__)));  


//Ruta url Ejemplo: http://localhost/crm_mvc/
define('PATH_URL','http://localhost/crm_mvc');


//Configuración de acceso a la base de datos
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','crm_p');


define("controller_default", "Login");

define("method_default", "index");

//constante para procesar por hash o encriptación
const METHOD="AES-256-CBC";
const SECRET_KEY='€PRESTAMOS@2021';
const SECRET_IV='067452';

?>