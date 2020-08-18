<?php

// Leonardo Fabian
// 2019-7407

require_once "connection.php";

class MedicamentosModel{

    // Obtener datos desde una API
    static public function mdlConsultarAPI($url){
        $datos = file_get_contents($url);
        $datos = json_decode($datos);
        
        return $datos;
    }

    static public function mdlCreate($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("insert into $tabla (codigo, nombreComercial, principioActivo, presentacion, estatus, frecuencia
        ) values (:codigo, :nombreComercial, :principioActivo, :presentacion, :estatus, :frecuencia)");

        $stmt -> bindParam(":codigo", $datos['codigo'], PDO::PARAM_STR);
        $stmt -> bindParam(":nombreComercial", $datos['nombreComercial'], PDO::PARAM_STR);
        $stmt -> bindParam(":principioActivo", $datos['principioActivo'], PDO::PARAM_STR);
        $stmt -> bindParam(":presentacion", $datos['presentacion'], PDO::PARAM_STR);
        $stmt -> bindParam(":estatus", $datos['estatus'], PDO::PARAM_STR);   
        $stmt -> bindParam(":frecuencia", $datos['frecuencia'], PDO::PARAM_STR); 

        if($stmt->execute()){
            return "success";
        } else {
            return "error";
        }

        $stmt = null;

    }

    // Seleccionar todos o un medicamento
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

    // Actualizar medicamento
    static public function mdlUpdate($tabla, $datos){        

        $stmt = Conexion::conectar()->prepare("update $tabla set codigo = :codigo, nombreComercial = :nombreComercial, principioActivo = :principioActivo, presentacion = :presentacion, estatus = :estatus where id = :id");

        $stmt->bindParam(":id", $datos['id'], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_STR);
        $stmt->bindParam(":nombreComercial", $datos['nombreComercial'], PDO::PARAM_STR);
        $stmt->bindParam(":principioActivo", $datos['principioActivo'], PDO::PARAM_STR);
        $stmt->bindParam(":presentacion", $datos['presentacion'], PDO::PARAM_STR);
        $stmt->bindParam(":estatus", $datos['estatus'], PDO::PARAM_STR);        

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