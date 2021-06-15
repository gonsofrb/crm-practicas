<?php
    /**
     * Mapear la url ingresada en el navegador
     * 0-Controlador
     * 1-Método
     * 2-Parámetros
     * 
     * Ejemplo: /usuarios/actualizar/4
     */

    class Core{
        protected $controller_default = controller_default;
        protected $method_default = method_default;
        protected $parameters = [];

        //Constructor
        public function __construct(){
            $url = $this->getUrl();
           //print_r($this->getUrl());

           //Verificamos si existe el controlador
           if(!empty($url[0] ) && file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            //Si existe se setea como controlador por defecto
            $this->controller_default = ucwords($url[0]);

            unset($url[0]);
           }

           //Requerir el controlador
           require_once '../app/controllers/'. $this->controller_default. '.php';
           $this->controller_default = new $this->controller_default;

           //Verificamos el método
           if(isset($url[1])){
                if(method_exists($this->controller_default,$url[1])){
                    //Asignamos el método
                    $this->method_default = $url[1];
                    unset($url[1]);
                }
            }
            //Prueba traer método
            //echo $this->metodoActual;

            //Obtener los parámetros
            $this->parameters = $url ? array_values($url) : [];
            //Llamar callback con parametros array
            call_user_func_array([$this->controller_default, $this->method_default], $this->parameters);
        }


        //Función para obtener la url
        //Retorna un array dividido en /
        public function getUrl(){
            //echo $_GET['url'];

            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
    }



?>