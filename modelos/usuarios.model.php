<?php

// Leonardo Fabian
// 2019-7407

require_once "connection.php";

class UsuariosModel{

    static public function mdlCreate($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("insert into $tabla (usuario, nombre, apellido, pass, rol, estatus
        ) values (:usuario, :nombre, :apellido, :pass, :rol, :estatus)");

        $stmt -> bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);
        $stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt -> bindParam(":apellido", $datos['apellido'], PDO::PARAM_STR);
        $stmt -> bindParam(":pass", $datos['pass'], PDO::PARAM_STR);
        $stmt -> bindParam(":rol", $datos['rol'], PDO::PARAM_STR);
        $stmt -> bindParam(":estatus", $datos['estatus'], PDO::PARAM_STR);

        if($stmt->execute()){
            return "success";
        } else {
            return "error";
        }

        $stmt = null;

    }

    static public function mdlRead($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("select * from $tabla where $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch(); 

        } else {

            $stmt = Conexion::conectar()->prepare("select * from $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll(); 

        }

    }

    static public function mdlReadDoctores($tabla, $valor){

            $stmt = Conexion::conectar()->prepare("select * from $tabla where rol = :$valor");

            $stmt -> bindParam(":".$valor, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll(); 
    }



    static public function mdlUpdate($tabla, $datos){

        var_dump($datos);

        $stmt = Conexion::conectar()->prepare("update $tabla set nombre = :nombre, apellido = :apellido, pass = :pass, rol = :rol where usuario = :usuario");

        $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos['apellido'], PDO::PARAM_STR);
        $stmt->bindParam(":pass", $datos['pass'], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos['rol'], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);

        if($stmt -> execute()){
			return "success";
		}else{
			return "error";
        }		
        
		$stmt = null;
    }


    // ELIMINAR USUARIO
    static public function mdlDelete($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("delete from $tabla where id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "success";

		} else {

			return "error";

		}
		$stmt = null;

    }

}