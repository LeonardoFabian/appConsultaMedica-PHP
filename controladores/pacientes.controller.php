<?php

// Leonardo Fabian
// 2019-7407

class PacientesController{

    // CREAR PACIENTE
    static public function ctrCreate(){        

        if(isset($_POST["nuevo-cedula"])){

			if(	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevo-paciente-nombre"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevo-paciente-apellido"]) 
                ){

                $tabla = "pacientes";    
                
                $datos = array(
                    "cedula" => '',
                    "nombre" => '',
                    "apellido" => '',
                    "fechaNacimiento" => '',
                    "tipoSanguineo" => '',
                    "telefono" => '',
                    "consultas" => 0
                );
                
                $cedula = isset($_POST['nuevo-cedula']) ? $_POST['nuevo-cedula'] : false;
                $nombre = isset($_POST['nuevo-paciente-nombre']) ? $_POST['nuevo-paciente-nombre'] : false;
                $apellido = isset($_POST['nuevo-paciente-apellido']) ? $_POST['nuevo-paciente-apellido'] : false;
                $fechaNacimiento = isset($_POST['nuevo-paciente-nacimiento']) ? $_POST['nuevo-paciente-nacimiento'] : false;                
                $tipoSanguineo = isset($_POST['nuevo-paciente-gruposanguineo']) ? $_POST['nuevo-paciente-gruposanguineo'] : false;
                $telefono = isset($_POST['nuevo-paciente-telefono']) ? $_POST['nuevo-paciente-telefono'] : false;               

                if(!empty($nombre) && !is_numeric($nombre) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)){
                    $datos['nombre'] = $nombre;
                } else {
                    echo "<script>alert('El campo nombre no puede contener caracteres especiales!');</script>";        
                }

                if(!empty($apellido) && !is_numeric($apellido) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $apellido)){
                    $datos['apellido'] = $apellido;
                } else {
                    echo "<script>alert('El campo apellido no puede contener caracteres especiales!');</script>";       
                }

                if(!empty($cedula) && preg_match('/^[0-9]+$/', $cedula)){
                    $datos['cedula'] = $cedula;
                } else {
                    echo "<script>alert('El campo cedula no puede estar vacio ni contener espacios o letras!');</script>";       
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

                
                //cifrar password  
				//$datos['pass'] = crypt($verifiedPass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$result = PacientesModel::mdlCreate($tabla, $datos);

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El paciente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "pacientes";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El paciente no pudo ser creado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "pacientes";
						}

					});				

				</script>';
			}
		}
    }

    // MOSTRAR PACIENTES
    static public function ctrRead($item, $valor){

        $tabla = "pacientes";
        $datos = PacientesModel::mdlRead($tabla, $item, $valor);
        return $datos;

    }

    // CARGAR DATOS PACIENTES DESDE API
    static public function ctrConsultarAPI($item, $valor){
        
        $url = "http://173.249.49.169:88/api/test/{$item}/{$valor}";
        $datos = PacientesModel::mdlConsultarAPI($url);
        return $datos;
         
    }

    // EDITAR PACIENTE
    static public function ctrUpdate(){

        if(isset($_POST["editar-cedula"])){

			if(	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-paciente-nombre"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-paciente-apellido"]) 			
				){

                $tabla = "pacientes";    
                
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
							window.location = "pacientes";
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
							window.location = "pacientes";
						}

					});				

				</script>';
			}
		}
    }


    // ELIMINAR PACIENTE 
    static public function ctrDelete(){

        if(isset($_GET['idPacienteEliminar'])){

            $tabla = "pacientes";
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
                        window.location = "pacientes";
                    }

                });				

            </script>';

            }

        } 
    }

}