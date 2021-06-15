<?php 
 if(!isset($_SESSION)){
   session_start();  
 };

if(!isset($_SESSION['nombre_usu_crm'])){
    header("Location:".PATH_URL."/Login/index/");
}


?>