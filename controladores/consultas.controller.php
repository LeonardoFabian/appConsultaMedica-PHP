<?php

// Leonardo Fabian
// 2019-7407

class ConsultasController{

    // CREAR CONSULTA
    static public function ctrCreate($estatus){        

        if(isset($_POST["nuevaReceta"])){

			if(	isset($_POST['idDoctor']) &&
                isset($_POST['seleccionarPaciente']) 
                ){

                    // AUMENTAR LA FRECUENCIA DE USO DE UN MEDICAMENTO

                    $listaMedicamentos = json_decode($_POST['listaMedicamentos'], true);

                    foreach($listaMedicamentos as $key => $value){

                        // obtener medicamento a actualizar
                        $tablaMedicamentos = "medicamentos";
                        $item = "id";
                        $valor = $value["id"];

                        $traerMedicamento = MedicamentosModel::mdlRead($tablaMedicamentos, $item, $valor);

                        // actualizar frecuencia
                        $item = "frecuencia";
                        $valor1 = 1 + $traerMedicamento["frecuencia"];

                        $actualizarFrecuencia = MedicamentosModel::mdlUpdateColumn($tablaMedicamentos, $item, $valor1, $valor);

                    }

                    // obtener paciente a actualizar
                    $tablaPacientes = "pacientes";
                    $item = "id";
                    $valor = $_POST['seleccionarPaciente'];
                    $traerPacientes = PacientesModel::mdlRead($tablaPacientes, $item, $valor);                    

                    // actualizar cantidad de consultas
                    $item = "consultas";
                    $valor1 = 1 + $traerPacientes["consultas"];
                    $actualizarConsultas = PacientesModel::mdlUpdateColumn($tablaPacientes, $item, $valor1, $valor);

                    
                    // Obtener fecha y hora
						
                    date_default_timezone_set('America/La_Paz'); //RD TimeZone

                    $date = date('Y-m-d');
                    $time = date('H:i:s');

                    $currentDate = $date.' '.$time;

                    // Registrar fecha ultima consutla                   

                    $item = "ultima_consulta";
                    $valor1 = $currentDate;                    
                    $valor2 = $_POST["seleccionarPaciente"];

                    $ultimaConsulta = PacientesModel::mdlUpdateColumn($tablaPacientes, $item, $valor1, $valor2);


                $tabla = "consultas";    
                
                $datos = array(
                    "codigo" => $_POST["nuevaReceta"],
                    "paciente_id" => '',
                    "usuario_id" => '',
                    "servicio_id" => '',
                    "medicamentos" => '',
                    "motivo" => '',
                    "comentario" => '',
                    "impuesto" => '',
                    "neto" => '',
                    "total" => '',
                    "metodo_pago" => '',
                    "estatus_pago" => $estatus,
                    "usuario_registra_pago" => 0
                );
                
                $codigo = isset($_POST['nuevaReceta']) ? $_POST['nuevaReceta'] : false;
                $pacienteId = isset($_POST['seleccionarPaciente']) ? $_POST['seleccionarPaciente'] : false;
                $usuarioId = isset($_POST['idDoctor']) ? $_POST['idDoctor'] : false;
                $servicioId = isset($_POST['seleccionarServicio']) ? $_POST['seleccionarServicio'] : false;                
                $medicamentos = isset($_POST['listaMedicamentos']) ? $_POST['listaMedicamentos'] : false;
                $motivo = isset($_POST['detallesMotivoConsulta']) ? $_POST['detallesMotivoConsulta'] : false;   
                $comentario = isset($_POST['detallesComentarioConsulta']) ? $_POST['detallesComentarioConsulta'] : false;   
                $impuesto = isset($_POST['nuevoPrecioImpuesto']) ? $_POST['nuevoPrecioImpuesto'] : false;   
                $neto = isset($_POST['nuevoPrecioNeto']) ? $_POST['nuevoPrecioNeto'] : false;   
                $total = isset($_POST['totalConsultaSinFormato']) ? $_POST['totalConsultaSinFormato'] : false;   
                $metodoPago = isset($_POST['nuevoMetodoPago']) ? $_POST['nuevoMetodoPago'] : false;   
                   

                if( !empty($codigo) ){
                    $datos['codigo'] = $codigo;
                } else {
                    echo "<script>alert('El código no puede estar vacío!');</script>";        
                }

                if(!empty($pacienteId)){
                    $datos['paciente_id'] = $pacienteId;
                } else {
                    echo "<script>alert('Debe seleccionar un paciente');</script>";       
                }

                if(!empty($usuarioId)){
                    $datos['usuario_id'] = $usuarioId;
                } else {
                    echo "<script>alert('Las consultas deben ser creadas por un Doctor!');</script>";       
                }                  
                
                if(!empty($servicioId)){
                    $datos['servicio_id'] = $servicioId;
                } else {
                    echo "<script>alert('Debe seleccionar un tipo de servicio!');</script>";       
                }

                if(!empty($medicamentos)){
                    $datos['medicamentos'] = $medicamentos;
                } else {
                    echo "<script>alert('Debe agregar al menos un medicamento!');</script>";       
                }

                if(!empty($motivo)){
                    $datos['motivo'] = $motivo;
                } else {
                    echo "<script>alert('Debe agregar al menos un motivo de consulta!');</script>";       
                }
               
                $datos['comentario'] = $comentario;     
                
                if(!empty($impuesto)){
                    $datos['impuesto'] = $impuesto;
                    $datos['neto'] = $neto;
                } else {
                    $datos['impuesto'] = 0;     
                    $datos['neto'] = 0;  
                }

                if(!empty($total)){
                    $datos['total'] = $total;
                } else {
                    echo "<script>alert('Debe seleccionar un tipo de servicio para calcular el total!');</script>";        
                }

                if(!empty($metodoPago)){
                    $datos['metodo_pago'] = $metodoPago;
                } else {
                    $datos['metodo_pago'] = '';        
                }              
               				
				$result = ConsultasModel::mdlCreate($tabla, $datos);

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La consulta se ha guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "consultas";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡La consulta no pudo ser creada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "consultas";
						}

					});				

				</script>';
			}
		}
    }

    // MOSTRAR CONSULTAS
    static public function ctrRead($item, $valor){

        $tabla = "consultas";
        $datos = ConsultasModel::mdlRead($tabla, $item, $valor);
        return $datos;

    }



    static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

        $tabla = "consultas";
        $result = ConsultasModel::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

        return $result;

    }
    

    // EDITAR CONSULTA
    static public function ctrUpdate(){

        if(isset($_POST["editar-cedula"])){

			if(	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-paciente-nombre"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-paciente-apellido"]) 			
				){                  


                $tabla = "consultas";    
                
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
							window.location = "consultas";
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
							window.location = "consultas";
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
                        window.location = "consultas";
                    }

                });				

            </script>';

            }

        } 
    }

}