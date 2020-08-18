<?php

// Leonardo Fabian
// 2019-7407

class UsuariosController{

    
    static public function ctrCreate(){        

        if(isset($_POST["nuevo-usuario"])){

			if(	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevo-nombre"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevo-apellido"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevo-usuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevo-pass"])){

                $tabla = "usuarios";    
                
                $datos = array(
                    "nombre" => '',
                    "apellido" => '',
                    "usuario" => '',
                    "pass" => '',
                    "rol" => '',
                    "estatus" => 1
                );
                
                $nombre = isset($_POST['nuevo-nombre']) ? $_POST['nuevo-nombre'] : false;
                $apellido = isset($_POST['nuevo-apellido']) ? $_POST['nuevo-apellido'] : false;
                $usuario = isset($_POST['nuevo-usuario']) ? $_POST['nuevo-usuario'] : false;                
                $pass = isset($_POST['nuevo-pass']) ? $_POST['nuevo-pass'] : false;
                $rol = isset($_POST['nuevo-rol']) ? $_POST['nuevo-rol'] : false;               

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

                if(!empty($usuario) && preg_match('/^[a-zA-Z0-9]+$/', $usuario)){
                    $datos['usuario'] = $usuario;
                } else {
                    echo "<script>alert('El campo usuario no puede estar vacio ni contener caracteres especiales!');</script>";       
                }

                if(!empty($pass) && preg_match('/^[a-zA-Z0-9]+$/', $pass)){                         
                    $datos['pass'] = $pass; 
                } else {
                    echo "<script>alert('El campo password no puede contener caracteres especiales!');</script>";                   
                }    
                
                if(!empty($rol) && !is_numeric($rol) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $rol)){
                    $datos['rol'] = $rol;
                } else {
                    echo "<script>alert('El usuario debe tener definido un rol!');</script>";       
                }

                
                //cifrar password  
				//$datos['pass'] = crypt($verifiedPass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$result = UsuariosModel::mdlCreate($tabla, $datos);

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "usuarios";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede estar vacío ni contener caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "usuarios";
						}

					});				

				</script>';
			}
		}
    }

    static public function ctrRead($item, $valor){

        $tabla = "usuarios";
        $datos = UsuariosModel::mdlRead($tabla, $item, $valor);
        return $datos;

    }

    // EDITAR USUARIO
    static public function ctrUpdate(){

        if(isset($_POST["editar-usuario"])){

			if(	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-nombre"]) &&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editar-apellido"]) 			
				){

                $tabla = "usuarios";    
                
                $datos = array(
                    "nombre" => '',
                    "apellido" => '',
                    "usuario" => $_POST['editar-usuario'],
                    "pass" => '',
                    "rol" => ''
                );
                
                $nombre = isset($_POST['editar-nombre']) ? $_POST['editar-nombre'] : false;
                $apellido = isset($_POST['editar-apellido']) ? $_POST['editar-apellido'] : false;                              
                $pass = !empty($_POST['editar-pass']) ? $_POST['editar-pass'] : false;               
                $rol = isset($_POST['editar-rol']) ? $_POST['editar-rol'] : false;               

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

                if(!empty($pass) && preg_match('/^[a-zA-Z0-9]+$/', $pass)){                         
                    $datos['pass'] = $pass; 
                } else {
                    $datos['pass'] = $_POST['pass-actual'];                  
                }    
                
                if(!empty($rol) && !is_numeric($rol) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $rol)){
                    $datos['rol'] = $rol;
                } else {
                    echo "<script>alert('El usuario debe tener definido un rol!');</script>";       
                }                
                
                //cifrar password  
				//$datos['pass'] = crypt($verifiedPass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
                $result = UsuariosModel::mdlUpdate($tabla, $datos);               
                

				if($result == "success"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido modificado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "usuarios";
						}

					});				

				</script>';

				}

			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡Error al editar usuario!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "usuarios";
						}

					});				

				</script>';
			}
		}
    }


    /* ELIMINAR USUARIO */
    static public function ctrDelete(){

        if(isset($_GET['idUsuarioEliminar'])){

            $tabla = "usuarios";
            $datos = $_GET['idUsuarioEliminar'];

            $result = UsuariosModel::mdlDelete($tabla, $datos);

            if($result == "success"){

                echo '<script>

                swal({

                    type: "success",
                    title: "¡Usuario eliminado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){						
                        window.location = "usuarios";
                    }

                });				

            </script>';

            }

        } 
    }

}