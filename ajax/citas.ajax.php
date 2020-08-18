<?php

require_once "../controladores/citas.controller.php";
require_once "../modelos/citas.model.php";

class CitasAjax{

    public $fechaCita;

    public function ajaxConsultarFecha(){
        $item = "dia";
        $valor = $this->fechaCita;
        $result = CitasController::ctrRead($item, $valor);

        echo json_encode($result);
    }

    public $horaInicio;
    public $horaTermino;
    public $fecha;

    public function ajaxConsultarHora(){
        $item1 = "horaInicio";
        $valor1 = $this->horaInicio;
        $item2 = "horaInicio";
        $valor2 = $this->horaTermino;
        $tabla = "citas";
        $fecha = $this->fecha;
        $result = CitasModel::mdlReadHoras($tabla, $item1, $valor1, $item2, $valor2, $fecha);

        echo json_encode($result);
    }
}

// consultar fecha
if(isset($_POST['fechaCita'])){
    $fecha = new CitasAjax();
	$fecha -> fechaCita = $_POST["fechaCita"];
	$fecha -> ajaxConsultarFecha();
}

// consultar hora
if(isset($_POST['horaInicio'])){
    $hora = new CitasAjax();
    $hora -> horaInicio = $_POST["horaInicio"];
    $hora -> horaTermino = $_POST["horaTermino"];
    $hora -> fecha = $_POST["fecha"];
	$fecha -> ajaxConsultarHora();
}