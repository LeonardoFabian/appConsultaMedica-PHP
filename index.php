<?php

// Ramon L. Fabian
// 2019-7407

require_once "controladores/plantilla.controller.php";
require_once "controladores/usuarios.controller.php";
require_once "controladores/login.controller.php";
require_once "controladores/pacientes.controller.php";
require_once "controladores/citas.controller.php";
require_once "controladores/consultas.controller.php";
require_once "controladores/medicamentos.controller.php";
require_once "controladores/administracion.controller.php";
require_once "controladores/servicios.controller.php";

require_once "modelos/usuarios.model.php";
require_once "modelos/login.model.php";
require_once "modelos/pacientes.model.php";
require_once "modelos/citas.model.php";
require_once "modelos/consultas.model.php";
require_once "modelos/medicamentos.model.php";
require_once "modelos/administracion.model.php";
require_once "modelos/servicios.model.php";

$plantilla = new PlantillaController();
$plantilla -> ctrPlantilla();