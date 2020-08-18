<?php

class LoginModel{

     // Activar usuario y registrar el ultimo login
     static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){
        $stmt = Conexion::conectar()->prepare("update $tabla set $item1 = :$item1 where $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1,PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2,PDO::PARAM_STR);      

        if($stmt -> execute()){
            return "success";
        } else {
            return "error";
        }

        $stmt = null;
    }
    
}
