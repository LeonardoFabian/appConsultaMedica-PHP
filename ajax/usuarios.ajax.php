<?php

require_once "../controladores/usuarios.controller.php";
require_once "../modelos/usuarios.model.php";

class UsuariosAjax{

    public $idUsuario;

    public function ajaxEditarUsuario(){
        $item = "id";
        $valor = $this->idUsuario;
        $result = UsuariosController::ctrRead($item, $valor);

        echo json_encode($result);
    }
}

// Editar usuario
if(isset($_POST['idUsuario'])){
    $editar = new UsuariosAjax();
    $editar -> idUsuario = $_POST['idUsuario'];
    $editar -> ajaxEditarUsuario();
}