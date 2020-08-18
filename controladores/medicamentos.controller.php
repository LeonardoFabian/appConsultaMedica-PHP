<?php

// Leonardo Fabian
// 2019-7407

class MedicamentosController{

    // CREAR PACIENTE
    static public function ctrCreate(){        

        if(isset($_POST["nuevo-codigoMedicamento"])){

			if(	!empty($_POST["nuevo-nombreComercial"]) &&
                !empty($_POST["nuevo-principioActivo"]) 
                ){

                $tabla = "medicamentos";    
                
                $datos = array(
                    "codigo" => $_POST["nuevo-codigoMedicamento"],
                    "nombreComercial" => '',
                    "principioActivo" => '',
                    "presentacion" => '',
                    "gtin" => '',
                    "estatus" => 1, 
                    "frecuencia" => 0
                );                
               
                $nombreComercial = isset($_POST['nuevo-nombreComercial']) ? $_POST['nuevo-nombreComercial'] : false;
                $principioActivo = isset($_POST['nuevo-principioActivo']) ? $_POST['nuevo-principioActivo'] : false;
                $presentacion = isset($_POST['nuevo-presentacion']) ? $_POST['nuevo-presentacion'] : false;                                         

                
                if(!empty($nombreComercial) && !is_numeric($nombreComercial)){
                    $datos['nombreComercial'] = $nombreComercial;
                } else {
                    echo "<script>alert('El campo nombre comercial no puede contener caracteres especiales!');</script>";        
                }

                if(!empty($principioActivo) && !is_numeric($principioActivo)){
                    $datos['principioActivo'] = $principioActivo;
                } else {
                    echo "<script>alert('El campo principio activo no puede contener caracteres especiales!');</script>";       
                }                            
                
                if(!empty($presentacion) && !is_numeric($presentacion)){
                    $datos['presentacion'] = $presentacion;
                } else {
                    echo "<script>alert('El campo presentación no puede contener caracteres especiales!');</script>";       
                }  
                				
				$result = MedicamentosModel::mdlCreate($tabla, $datos);

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El medicamento ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "medicamentos";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El medicamento no pudo ser creado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "medicamentos";
						}

					});				

				</script>';
			}
		}
    }

    // MOSTRAR MEDICAMENTOS
    static public function ctrRead($item, $valor){

        $tabla = "medicamentos";
        $datos = MedicamentosModel::mdlRead($tabla, $item, $valor);
        return $datos;

    }   

    // EDITAR MEDICAMENTO
    static public function ctrUpdate(){

        if(isset($_POST["editar-codigoMedicamento"])){

			if(	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-nombreComercial"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-principioActivo"]) 			
				){

                $tabla = "medicamentos";    
                
                $datos = array(
                    "id" => '',
                    "codigo" => '',
                    "nombreComercial" => '',
                    "principioActivo" => '',
                    "presentacion" => '',
                    "gtin" => '',
                    "estatus" => ''
                );                
                
                $codigo = isset($_POST['editar-codigoMedicamento']) ? $_POST['editar-codigoMedicamento'] : false;
                $nombreComercial = isset($_POST['editar-nombreComercial']) ? $_POST['editar-nombreComercial'] : false;                              
                $principioActivo = !empty($_POST['editar-principioActivo']) ? $_POST['editar-principioActivo'] : false;               
                $presentacion = isset($_POST['editar-presentacion']) ? $_POST['editar-presentacion'] : false;               
                $estatus = isset($_POST['editar-estatusMedicamento']) ? $_POST['editar-estatusMedicamento'] : false;
                             
                if(!empty($codigo) ){
                    $datos['codigo'] = $codigo;
                } else {
                    echo "<script>alert('El campo codigo no puede estar vacío!');</script>";        
                }

                if(!empty($nombreComercial) ){
                    $datos['nombreComercial'] = $nombreComercial;
                } else {
                    echo "<script>alert('El campo nombreComercial no puede estar vacío!');</script>";       
                }                

                if(!empty($principioActivo)){
                    $datos['principioActivo'] = $principioActivo;
                } else {
                    echo "<script>alert('El campo principio activo no puede estar vacío!');</script>";       
                }

                if(!empty($presentacion)){
                    $datos['presentacion'] = $presentacion;
                } else {
                    echo "<script>alert('El campo presentación no puede estar vacío!');</script>";       
                }

                if(!empty($estatus)){
                    $datos['estatus'] = $estatus;
                } else {
                    echo "";       
                }                     
               
				
                $result = MedicamentosModel::mdlUpdate($tabla, $datos);               
                

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El medicamento ha sido modificado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "medicamentos";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡Error al editar medicamentos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "medicamentos";
						}

					});				

				</script>';
			}
		}
    }


    // ELIMINAR PACIENTE 
    static public function ctrDelete(){

        if(isset($_GET['idPacienteEliminar'])){

            $tabla = "medicamentos";
            $datos = $_GET['idPacienteEliminar'];

            $result = PacientesModel::mdlDelete($tabla, $datos);

            if($result == "success"){

                echo '<script>

                swal({

                    type: "success",
                    title: "¡Paciente eliminado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){						
                        window.location = "medicamentos";
                    }

                });				

            </script>';

            }

        } 
    }

}