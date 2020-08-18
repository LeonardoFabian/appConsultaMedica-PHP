<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultorio</title>
    <!-- Bootstrap 3.3.7 -->  
    <link rel="stylesheet" href="vistas/plugins/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <!-- Custom CSS -->  
    <link rel="stylesheet" href="vistas/css/style.css">
    <!-- icon -->  
    <link rel="icon" href="vistas/images/logo.png">
    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/plugins/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- Daterange Picker -->
    <link rel="stylesheet" href="vistas/extensiones/daterangepicker/daterangepicker.css">
    <!-- Sweet Alert 2 -->
    <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
</head>
<body>

    <?php

        if(file_exists("modelos/configuration.php")){

            if(isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'OK'){

            include "vistas/modulos/header.php";

                echo '<main role="main">';
                    echo "<div class='content container-fluid'>";                        

                        if(isset($_GET['route'])){
                            if($_GET['route'] == "inicio" ||
                                $_GET['route'] == "usuarios" ||                             
                                $_GET['route'] == "pacientes" ||
                                $_GET['route'] == "citas" ||
                                $_GET['route'] == "consultas" ||
                                $_GET['route'] == "crear-consulta" ||
                                $_GET['route'] == "medicamentos" ||        
                                $_GET['route'] == "administracion" ||                                 
                                $_GET['route'] == "servicios" ||                      
                                $_GET['route'] == "login" ||          
                                $_GET['route'] == "salir"                     
                            ){
                                include "modulos/".$_GET['route'].".php";
                            } else {
                                include "modulos/404.php";
                            }
                        } else {
                            include "modulos/inicio.php";
                        }

                    echo "</div>";
                echo "</div>";

            include "vistas/modulos/footer.php";
        } else {
            include 'modulos/login.php';
        }
    } else {
        header('Location:install.php');
    }
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="vistas/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="vistas/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vistas/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>    
    <!-- Datarange picker -->
    <script src="vistas/extensiones/daterangepicker/moment.min.js"></script>
    <script src="vistas/extensiones/daterangepicker/daterangepicker.js"></script>
    
    <!-- jQuery Number -->  
    <script src="vistas/plugins/jquery-number/jquerynumber.min.js"></script>       
    <script src="vistas/js/datatable.js"></script>
    <script src="vistas/js/usuarios.js"></script>
    <script src="vistas/js/pacientes.js"></script>
    <script src="vistas/js/citas.js"></script>
    <script src="vistas/js/consultas.js"></script>
    <script src="vistas/js/servicios.js"></script>
    <script src="vistas/js/medicamentos.js"></script>
    <script src="vistas/js/print.js"></script>
</body>
</html>