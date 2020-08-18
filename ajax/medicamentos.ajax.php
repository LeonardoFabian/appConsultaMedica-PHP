<?php

require_once "../controladores/medicamentos.controller.php";
require_once "../modelos/medicamentos.model.php";

class MedicamentosAjax{

    public $idMedicamento;

    public function ajaxConsultarMedicamento(){
        $item = "id";
        $valor = $this->idMedicamento;
        $result = MedicamentosController::ctrRead($item, $valor);

        echo json_encode($result);
    }
}

// consultar medicamento
if(isset($_POST['idMedicamento'])){
    $consultarMedicamento = new MedicamentosAjax();
	$consultarMedicamento -> idMedicamento = $_POST["idMedicamento"];
	$consultarMedicamento -> ajaxConsultarMedicamento();
}

