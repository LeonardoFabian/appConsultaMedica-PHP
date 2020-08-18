<?php

class LoginController{

    static public function ctrIngresoUsuario(){

        if(isset($_POST['ingUsuario'])){

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])
            ){

                //$encryptedPwd = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = 'usuarios';

                $item = 'usuario';

                $valor = $_POST['ingUsuario'];

                $datos = UsuariosModel::mdlRead($tabla, $item, $valor);                      

                if($datos['usuario'] == $_POST['ingUsuario'] && $datos['pass'] == $_POST['ingPassword']){

                    if($datos['estatus'] == 1){

                        $_SESSION['iniciarSesion'] = "OK";
                        $_SESSION['id'] = $datos['id'];
                        $_SESSION['nombre'] = $datos['nombre'];
                        $_SESSION['apellido'] = $datos['apellido'];
                        $_SESSION['usuario'] = $datos['usuario'];                        
                        $_SESSION['rol'] = $datos['rol'];                        

                        // Registrar fecha y hora de login
                        date_default_timezone_set('America/Santo_Domingo');

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');

                        $fechaActual = $fecha.' '. $hora;

                        $item1 = 'ultimo_acceso';
                        $valor1 = $fechaActual;
                        $item2 = "id";
                        $valor2 = $datos['id'];

                        $ultimoLogin = LoginModel::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                        
                        if($ultimoLogin = "success"){
                            echo '<script>

                                swal({

                                    type: "success",
                                    title: "¡Credenciales ingresadas correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"

                                }).then(function(result){

                                    if(result.value){						
                                        window.location = "inicio";
                                    }

                                });				

                            </script>';

                        }                   

                    } else {

                        echo '<script>

                            swal({

                                type: "error",
                                title: "¡Datos erroneos, favor intente de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){

                                if(result.value){						
                                    window.location = "login";
                                }

                            });				

                        </script>';

                    }
                    

                } else {

                    echo '<div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

                }

                

            }

        }

    }
    
}