<?php

require_once "../controladores/servicios.controller.php";
require_once "../modelos/servicios.model.php";

class ServiciosAjax{

    public $idServicio;

    public function ajaxConsultarServicio(){
        $item = "id";
        $valor = $this->idServicio;
        $result = ServiciosController::ctrRead($item, $valor);

        echo json_encode($result);
    }
}

// consultar medicamento
if(isset($_POST['idServicio'])){
    $consultarServicio = new ServiciosAjax();
	$consultarServicio -> idServicio = $_POST["idServicio"];
	$consultarServicio -> ajaxConsultarServicio();
}

