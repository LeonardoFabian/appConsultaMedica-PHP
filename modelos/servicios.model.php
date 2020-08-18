<?php

// Leonardo Fabian
// 2019-7407

require_once "connection.php";

class ServiciosModel{

    static public function mdlConsultarAPI($url){
        $datos = file_get_contents($url);
        $datos = json_decode($datos);
        
        return $datos;
    }

    // CREAR SERVICIO
    static public function mdlCreate($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("insert into $tabla (nombre, costo) values (:nombre, :costo)");

        $stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);      
        $stmt -> bindParam(":costo", $datos['costo'], PDO::PARAM_STR);        

        if($stmt->execute()){
            return "success";
        } else {
            return "error";
        }

        $stmt = null;

    }

    static public function mdlRead($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("select * from $tabla where $item = :$item ORDER BY nombre ASC");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch(); 

        } else {

            $stmt = Conexion::conectar()->prepare("select * from $tabla ORDER BY nombre ASC");

            $stmt -> execute();

            return $stmt -> fetchAll(); 

        }

    }

    static public function mdlUpdate($tabla, $datos){        

        $stmt = Conexion::conectar()->prepare("update $tabla set nombre = :nombre, costo = :costo where id = :id");

        $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":costo", $datos['costo'], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos['id'], PDO::PARAM_STR);       

        if($stmt -> execute()){
			return "success";
		}else{
			return "error";
        }		
        
		$stmt = null;
    }


    // ACTUALIZAR CAMPO
    static public function mdlUpdateColumn($tabla, $item, $valor1, $valor2){

        $stmt = Conexion::conectar()->prepare("update $tabla set $item = :$item where id = :id");

        $stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor2, PDO::PARAM_STR);

        if($stmt->execute()){
            return "success";
        } else {
            return "error";
        }

        $stmt = null;

    }


    // ELIMINAR PACIENTE
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