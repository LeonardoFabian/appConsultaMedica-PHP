<?php

// Leonardo Fabian
// 2019-7407

require_once "connection.php";

class ConsultasModel{

    static public function mdlConsultarAPI($url){
        $datos = file_get_contents($url);
        $datos = json_decode($datos);
        
        return $datos;
    }

    
    static public function mdlCreate($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("insert into $tabla (codigo, paciente_id, usuario_id, servicio_id, medicamentos, motivo, comentario, impuesto, neto, total, metodo_pago, estatus_pago, usuario_registra_pago
        ) values (:codigo, :paciente_id, :usuario_id, :servicio_id, :medicamentos, :motivo, :comentario, :impuesto, :neto, :total, :metodo_pago, :estatus_pago, :usuario_registra_pago)");

        $stmt -> bindParam(":codigo", $datos['codigo'], PDO::PARAM_STR);
        $stmt -> bindParam(":paciente_id", $datos['paciente_id'], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario_id", $datos['usuario_id'], PDO::PARAM_STR);
        $stmt -> bindParam(":servicio_id", $datos['servicio_id'], PDO::PARAM_STR);
        $stmt -> bindParam(":medicamentos", $datos['medicamentos'], PDO::PARAM_STR);
        $stmt -> bindParam(":motivo", $datos['motivo'], PDO::PARAM_STR);
        $stmt -> bindParam(":comentario", $datos['comentario'], PDO::PARAM_STR);
        $stmt -> bindParam(":impuesto", $datos['impuesto'], PDO::PARAM_STR);
        $stmt -> bindParam(":neto", $datos['neto'], PDO::PARAM_STR);
        $stmt -> bindParam(":total", $datos['total'], PDO::PARAM_STR);
        $stmt -> bindParam(":metodo_pago", $datos['metodo_pago'], PDO::PARAM_STR);
        $stmt -> bindParam(":estatus_pago", $datos['estatus_pago'], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario_registra_pago", $datos['usuario_registra_pago'], PDO::PARAM_STR);

        if($stmt->execute()){
            return "success";
        } else {
            return "error";
        }

        $stmt = null;

    }



    static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

        if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("select * from $tabla ORDER BY id ASC");

            $stmt -> execute();

            return $stmt -> fetchAll(); 

        } else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("select * from $tabla where fecha like '%fechaFinal%'");

            $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll(); 

        } else {

            $stmt = Conexion::conectar()->prepare("select * from $tabla where fecha between '$fechaInicial' AND '$fechaFinal'");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }
    }



    static public function mdlRead($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("select * from $tabla where $item = :$item ORDER BY id ASC");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch(); 

        } else {

            $stmt = Conexion::conectar()->prepare("select * from $tabla ORDER BY id ASC");

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