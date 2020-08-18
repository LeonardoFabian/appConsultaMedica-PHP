<?php

// Leonardo Fabian
// 2019-7407

require_once "connection.php";

class CitasModel{

    static public function mdlConsultarAPI($url){
        $datos = file_get_contents($url);
        $datos = json_decode($datos);
        
        return $datos;
    }

    static public function mdlCreate($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("insert into $tabla (paciente_id, usuario_id, dia, horaInicio, horaTermino, estatus
        ) values (:paciente_id, :usuario_id, :dia, :horaInicio, :horaTermino, :estatus)");

        $stmt -> bindParam(":paciente_id", $datos['paciente_id'], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario_id", $datos['usuario_id'], PDO::PARAM_STR);
        $stmt -> bindParam(":dia", $datos['dia'], PDO::PARAM_STR);
        $stmt -> bindParam(":horaInicio", $datos['horaInicio'], PDO::PARAM_STR);
        $stmt -> bindParam(":horaTermino", $datos['horaTermino'], PDO::PARAM_STR);
        $stmt -> bindParam(":estatus", $datos['estatus'], PDO::PARAM_STR);

        if($stmt->execute()){
            return "success";
        } else {
            return "error";
        }

        $stmt = null;

    }

    static public function mdlReadHoras($tabla, $item1, $valor1, $item2, $valor2, $fecha){
        

            $stmt = Conexion::conectar()->prepare("select * from $tabla where fecha = :$fecha and $item1 >= :$item1 and $item2 <= :$item2 ");

            $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
            $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
            $stmt -> bindParam(":".$fecha, $fecha, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll(); 


        }

    static public function mdlRead($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("select * from $tabla where $item = :$item order by dia, horaInicio ASC");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch(); 

        } else {

            $stmt = Conexion::conectar()->prepare("select * from $tabla order by dia, horaInicio ASC");

            $stmt -> execute();

            return $stmt -> fetchAll(); 

        }

    }

    static public function mdlUpdate($tabla, $datos){        

        $stmt = Conexion::conectar()->prepare("update $tabla set nombre = :nombre, apellido = :apellido, fechaNacimiento = :fechaNacimiento, tipoSanguineo = :tipoSanguineo, telefono = :telefono where cedula = :cedula");

        $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos['apellido'], PDO::PARAM_STR);
        $stmt->bindParam(":fechaNacimiento", $datos['fechaNacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":tipoSanguineo", $datos['tipoSanguineo'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(":cedula", $datos['cedula'], PDO::PARAM_STR);

        if($stmt -> execute()){
			return "success";
		}else{
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