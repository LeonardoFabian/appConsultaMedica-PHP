<?php

require_once "../controladores/pacientes.controller.php";
require_once "../modelos/pacientes.model.php";

class PacientesAjax{

    // CARGAR DATOS DESDE LA API
    public $validarCedula;

    public function ajaxValidarCedula(){     
        $item = "consulta";   
        $valor = $this->validarCedula;
        $result = PacientesController::ctrConsultarAPI($item, $valor);

        echo json_encode($result);
    }

    // CONSULTAR CEDULA DESDE LA BASE DE DATOS
    public $consultarCedula;

    public function ajaxConsultarCedula(){     
        $item = "cedula";   
        $valor = $this->consultarCedula;
        $result = PacientesController::ctrRead($item, $valor);

        echo json_encode($result);
    }

    public $idPaciente;

    public function ajaxEditarPaciente(){
        $item = "id";
        $valor = $this->idPaciente;
        $result = PacientesController::ctrRead($item, $valor);

        echo json_encode($result);
    }
}

// Cargar datos con la cedula
if(isset($_POST["validarCedula"])){
	$validarCedula = new PacientesAjax();
	$validarCedula -> validarCedula = $_POST["validarCedula"];
	$validarCedula -> ajaxValidarCedula();
}

// Validar que el paciente no existe
if(isset($_POST['consultarCedula'])){
    $consultarCedula = new PacientesAjax();
	$consultarCedula -> consultarCedula = $_POST["consultarCedula"];
	$consultarCedula -> ajaxConsultarCedula();
}

// Mostrar datos paciente al editar
if(isset($_POST['idPaciente'])){
    $editarPaciente = new PacientesAjax();
    $editarPaciente -> idPaciente = $_POST["idPaciente"];
	$editarPaciente -> ajaxEditarPaciente();
}