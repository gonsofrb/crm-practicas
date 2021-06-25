<?php

    require_once '../app/models/ClientModel.php';

    class Presupuesto extends Controller{

        public function __construct(){
            $this->ClientModel = $this->model('ClientModel');
        }


        public function index(){
            $this->generar();
        }

        public function generar(){
            $clients = $this->ClientModel->all_customers();

            $data = [
                'clients'=>$clients
            ];

            $this->view('pages/presupuestos/presupuesto',$data);
        }




    }

?>