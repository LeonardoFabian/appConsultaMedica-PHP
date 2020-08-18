<?php

// Leonardo Fabian
// 2019-7407

class ServiciosController{

    // CREAR PACIENTE
    static public function ctrCreate(){        

        if(isset($_POST["nuevo-nombreServicio"])){

			if(	!empty($_POST["nuevo-nombreServicio"]) &&
                !empty($_POST["nuevo-costoServicio"]) 
                ){

                $tabla = "servicios";    
                
                $datos = array(
                    "nombre" => '',
                    "costo" => ''
                );                
               
                $nombre = isset($_POST['nuevo-nombreServicio']) ? $_POST['nuevo-nombreServicio'] : false;
                $costo = isset($_POST['nuevo-costoServicio']) ? $_POST['nuevo-costoServicio'] : false;                                                    
                
                if(!empty($nombre) && !is_numeric($nombre)){
                    $datos['nombre'] = $nombre;
                } else {
                    echo "<script>alert('El campo nombre no puede estar vacío!');</script>";        
                }

                if(!empty($costo)){
                    $datos['costo'] = $costo;
                } else {
                    echo "<script>alert('El campo costo no puede estar vacío!');</script>";       
                }                                                          
                				
				$result = ServiciosModel::mdlCreate($tabla, $datos);

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio ha sido creado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "servicios";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El servicio no pudo ser creado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "servicios";
						}

					});				

				</script>';
			}
		}
    }

    // MOSTRAR PACIENTES
    static public function ctrRead($item, $valor){

        $tabla = "servicios";
        $datos = ServiciosModel::mdlRead($tabla, $item, $valor);
        return $datos;

    }
    

    // EDITAR PACIENTE
    static public function ctrUpdate(){

        if(isset($_POST["editar-nombreServicio"])){

			if(	!empty( $_POST["editar-nombreServicio"]) &&
				!empty( $_POST["editar-costoServicio"]) 			
				){

                    // Obtener fecha y hora
						
                    date_default_timezone_set('America/La_Paz'); //RD TimeZone

                    $date = date('Y-m-d');
                    $time = date('H:i:s');

                    $currentDate = $date.' '.$time;

                    // Registrar fecha ultima consutla                   

                    $tablaServicios = "servicios";
                    $item = "ultima_modificacion";
                    $valor1 = $currentDate;                    
                    $valor2 = $_POST["idServicioEditar"];

                    $ultimaConsulta = ServiciosModel::mdlUpdateColumn($tablaServicios, $item, $valor1, $valor2);

                $tabla = "servicios";    
                
                $datos = array(
                    "id" => $_POST['idServicioEditar'],
                    "nombre" => '',
                    "costo" => ''
                );                
                
                $nombre = isset($_POST['editar-nombreServicio']) ? $_POST['editar-nombreServicio'] : false;
                $costo = isset($_POST['editar-costoServicio']) ? $_POST['editar-costoServicio'] : false;                                         
                             
                if(!empty($nombre) && !is_numeric($nombre)){
                    $datos['nombre'] = $nombre;
                } else {
                    echo "<script>alert('El campo nombre no puede contener caracteres especiales!');</script>";        
                }

                if(!empty($costo)){
                    $datos['costo'] = $costo;
                } else {
                    echo "<script>alert('El campo costo no puede estar vacío!');</script>";       
                }                              
				
                $result = ServiciosModel::mdlUpdate($tabla, $datos);               
                

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El servicio ha sido modificado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "servicios";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡Error al editar servicio!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "servicios";
						}

					});				

				</script>';
			}
		}
    }


    // ELIMINAR PACIENTE 
    static public function ctrDelete(){

        if(isset($_GET['idServicioEliminar'])){

            $tabla = "servicios";
            $datos = $_GET['idServicioEliminar'];

            $result = ServiciosModel::mdlDelete($tabla, $datos);

            if($result == "success"){

                echo '<script>

                swal({

                    type: "success",
                    title: "Servicio eliminado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){						
                        window.location = "servicios";
                    }

                });				

            </script>';

            }

        } 
    }

}