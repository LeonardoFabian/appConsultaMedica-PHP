<?php

// Leonardo Fabian R.
// 2019-7407
// Comentario

class CitasController{

    // CREAR PACIENTE
    static public function ctrCreate(){        

        if(isset($_POST["agendar-fecha-cita"])){

			if(	!empty($_POST["id-paciente"]) &&
				!empty($_POST["id-usuario"]) 
                ){

                $tabla = "citas";    
                
                $datos = array(
                    "paciente_id" => $_POST['id-paciente'],
                    "usuario_id" => $_POST['seleccionarDoctor'],
                    "dia" => '',
                    "horaInicio" => '',
                    "horaTermino" => '',
                    "estatus" => 1
                );
                
                $fechaCita = isset($_POST['agendar-fecha-cita']) ? $_POST['agendar-fecha-cita'] : false;
                $horaInicio = isset($_POST['hora-inicio']) ? $_POST['hora-inicio'] : false;
                $horaTermino = isset($_POST['hora-termino']) ? $_POST['hora-termino'] : false;                              

                if(!empty($fechaCita)){
                    $datos['dia'] = $fechaCita;
                } else {
                    echo "<script>alert('Debe seleccionar una fecha para la cita!');</script>";        
                }

                if(!empty($horaInicio)){
                    $datos['horaInicio'] = $horaInicio;
                } else {
                    echo "<script>alert('Debe seleccionar una hora de inicio para la cita!');</script>";        
                }

                if(!empty($horaTermino)){
                    $datos['horaTermino'] = $horaTermino;
                } else {
                    echo "<script>alert('Debe seleccionar una hora de término para la cita!');</script>";        
                }

                
                //cifrar password  
				//$datos['pass'] = crypt($verifiedPass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$result = CitasModel::mdlCreate($tabla, $datos);

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La cita ha sido creada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "citas";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡La cita no pudo ser creada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "citas";
						}

					});				

				</script>';
			}
		}
    }

    // MOSTRAR PACIENTES
    static public function ctrRead($item, $valor){

        $tabla = "citas";
        $datos = CitasModel::mdlRead($tabla, $item, $valor);
        return $datos;

    }
   

    // EDITAR PACIENTE
    static public function ctrUpdate(){

        if(isset($_POST["editar-cedula"])){

			if(	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-paciente-nombre"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-paciente-apellido"]) 			
				){

                $tabla = "citas";    
                
                $datos = array(
                    "cedula" => $_POST['editar-cedula'],
                    "nombre" => '',
                    "apellido" => '',
                    "fechaNacimiento" => '',
                    "tipoSanguineo" => '',
                    "telefono" => ''
                );                
                
                $nombre = isset($_POST['editar-paciente-nombre']) ? $_POST['editar-paciente-nombre'] : false;
                $apellido = isset($_POST['editar-paciente-apellido']) ? $_POST['editar-paciente-apellido'] : false;                              
                $fechaNacimiento = !empty($_POST['editar-paciente-nacimiento']) ? $_POST['editar-paciente-nacimiento'] : false;               
                $tipoSanguineo = isset($_POST['editar-paciente-gruposanguineo']) ? $_POST['editar-paciente-gruposanguineo'] : false;               
                $telefono = isset($_POST['editar-paciente-telefono']) ? $_POST['editar-paciente-telefono'] : false;
                             
                if(!empty($nombre) && !is_numeric($nombre)){
                    $datos['nombre'] = $nombre;
                } else {
                    echo "<script>alert('El campo nombre no puede contener caracteres especiales!');</script>";        
                }

                if(!empty($apellido) && !is_numeric($apellido)){
                    $datos['apellido'] = $apellido;
                } else {
                    echo "<script>alert('El campo apellido no puede contener caracteres especiales!');</script>";       
                }                

                if(!empty($fechaNacimiento)){
                    $datos['fechaNacimiento'] = $fechaNacimiento;
                } else {
                    echo "<script>alert('La fecha de nacimiento no puede estar vacía!');</script>";       
                }

                if(!empty($tipoSanguineo)){
                    $datos['tipoSanguineo'] = $tipoSanguineo;
                } else {
                    echo "<script>alert('El tipo sanguineo no puede estar vacío!');</script>";       
                }

                if(!empty($telefono) && preg_match('/^[0-9]+$/', $telefono)){
                    $datos['telefono'] = $telefono;
                } else {
                    echo "<script>alert('El campo teléfono no puede contener espacios ni guíones!');</script>";       
                }                     
               
				
                $result = PacientesModel::mdlUpdate($tabla, $datos);               
                

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El paciente ha sido modificado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "citas";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡Error al editar paciente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "citas";
						}

					});				

				</script>';
			}
		}
    }


    // ELIMINAR PACIENTE 
    static public function ctrDelete(){

        if(isset($_GET['idPacienteEliminar'])){

            $tabla = "citas";
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
                        window.location = "citas";
                    }

                });				

            </script>';

            }

        } 
    }

}