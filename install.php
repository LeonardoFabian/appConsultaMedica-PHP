<?php     

require_once "controladores/core.controller.php";
    
    if($_POST){

        //var_dump($_POST['admin_pass']);

        //$pass = crypt($_POST['admin_pass'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $con = mysqli_connect($_POST['db_host'],$_POST['db_user'],$_POST['db_pass']) or die(            
            "<script>
                alert('Conexión fallida, favor verificar');
                window.location = 'install.php';
            </script>"
        );       
        
        

        mysqli_query($con, "drop database `{$_POST['db_name']}`");
        mysqli_query($con, "create database `{$_POST['db_name']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;");
        mysqli_query($con, "use `{$_POST['db_name']}`");
        mysqli_query($con, "set names 'utf8'");

        $query = "CREATE TABLE `pacientes`(
                id INT(255) NOT NULL AUTO_INCREMENT,
                cedula VARCHAR(11) NOT NULL,
                nombre VARCHAR(50) NOT NULL, 
                apellido VARCHAR(50) NOT NULL, 
                fechaNacimiento DATE NOT NULL,
                tipoSanguineo VARCHAR(5) NOT NULL,
                telefono VARCHAR(11) NOT NULL,
                consultas INT(255) NULL,
                ultima_consulta DATETIME,
                CONSTRAINT pk_pacientes PRIMARY KEY(id)
            )ENGINE=InnoDb;
            
            ALTER TABLE pacientes ADD CONSTRAINT uk_cedula UNIQUE(cedula);
            
            CREATE TABLE `usuarios`(
                id INT(255) NOT NULL AUTO_INCREMENT,
                usuario VARCHAR(50) NOT NULL, 
                nombre VARCHAR(50) NOT NULL,
                apellido VARCHAR(50) NOT NULL,
                pass TEXT NOT NULL,
                rol VARCHAR(50) NOT NULL,
                estatus CHAR(1),
                fecha_registro TIMESTAMP,
                ultimo_acceso DATETIME,
                CONSTRAINT pk_usuarios PRIMARY KEY(id)
            )ENGINE=InnoDb;
            
            ALTER TABLE usuarios ADD CONSTRAINT uk_usuario UNIQUE(usuario);
            
            CREATE TABLE `citas`(
                id INT(255) NOT NULL AUTO_INCREMENT,
                paciente_id INT(255) NOT NULL,
                usuario_id INT(255) NOT NULL,
                dia DATE NOT NULL, 
                horaInicio  TIME NOT NULL,
                horaTermino TIME NOT NULL,
                estatus CHAR(1),
                CONSTRAINT pk_citas PRIMARY KEY(id)
            )ENGINE=InnoDb;
            
            CREATE TABLE `recetas`(
                id INT(255) NOT NULL AUTO_INCREMENT,
                medicamentos MEDIUMTEXT NOT NULL,
                CONSTRAINT pk_recetas PRIMARY KEY(id)    
            )ENGINE=InnoDb;
            
            CREATE TABLE `medicamentos`(
                id INT(255) NOT NULL AUTO_INCREMENT,
                codigo INT(255) NOT NULL,
                nombreComercial TEXT NOT NULL,
                principioActivo TEXT NOT NULL,
                presentacion TEXT NOT NULL,
                gtin TEXT NULL,
                estatus CHAR(1),
                frecuencia INT(255) NULL,
                CONSTRAINT pk_medicamentos PRIMARY KEY(id)   
            )ENGINE=InnoDb;
            
            CREATE TABLE `consultas`(
                id INT(255) NOT NULL AUTO_INCREMENT,
                codigo INT(255) NOT NULL,
                paciente_id INT(255) NOT NULL,                
                usuario_id INT(255) NOT NULL,
                servicio_id INT(255) NOT NULL,
                medicamentos MEDIUMTEXT NOT NULL,                
                motivo TEXT NOT NULL,
                comentario TEXT NULL,
                impuesto DECIMAL(9,2),
                neto DECIMAL(9,2),
                total DECIMAL(9,2),
                metodo_pago TEXT,
                estatus_pago CHAR(1),
                usuario_registra_pago INT(255),
                fecha TIMESTAMP,
                CONSTRAINT pk_consultas PRIMARY KEY(id)
            )ENGINE=InnoDb;

            CREATE TABLE `servicios`(
                id INT(255) NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(100) NOT NULL,
                costo DECIMAL(9,2),
                fecha_creacion TIMESTAMP,
                ultima_modificacion DATETIME,
                CONSTRAINT pk_servicios PRIMARY KEY(id)
            )ENGINE=InnoDb;

            ALTER TABLE servicios ADD CONSTRAINT uk_nombre UNIQUE(nombre);

            INSERT INTO servicios(nombre, costo) VALUES ('Consulta',500);
            INSERT INTO servicios(nombre, costo) VALUES ('Examén de laboratorio',500);
            INSERT INTO servicios(nombre, costo) VALUES ('Hospitalización',500);
            INSERT INTO servicios(nombre, costo) VALUES ('Rayos X',500);
            INSERT INTO servicios(nombre, costo) VALUES ('Ecografías',500);
            INSERT INTO servicios(nombre, costo) VALUES ('Terapia física',500);
            INSERT INTO servicios(nombre, costo) VALUES ('Cirugías',500);
            INSERT INTO servicios(nombre, costo) VALUES ('Consultas con especialistas',500);
                                                              
            
            ALTER TABLE citas ADD CONSTRAINT fk_citas_paciente FOREIGN KEY(paciente_id) REFERENCES pacientes(id);
            ALTER TABLE citas ADD CONSTRAINT fk_citas_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id);
            

           
            ALTER TABLE consultas ADD CONSTRAINT fk_consultas_paciente FOREIGN KEY(paciente_id) REFERENCES pacientes(id);            
            ALTER TABLE consultas ADD CONSTRAINT fk_consultas_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id);
            ALTER TABLE consultas ADD CONSTRAINT fk_consultas_servicio FOREIGN KEY(servicio_id) REFERENCES servicios(id);
            

            insert into usuarios(usuario, nombre, apellido, pass, rol, estatus)
            values(
                '{$_POST['admin_user']}',
                '{$_POST['admin_name']}',
                '{$_POST['admin_lastname']}',
                '{$_POST['admin_pass']}',
                'Administrador',                
                1
            );                                           
            
            ";        

        $con->multi_query($query);
        
        $file = <<<ARCHIVO
        <?php
        define('DB_HOST','{$_POST['db_host']}');
        define('DB_USER','{$_POST['db_user']}');
        define('DB_PASS','{$_POST['db_pass']}');
        define('DB_NAME','{$_POST['db_name']}');
        
        ARCHIVO;

        file_put_contents('modelos/configuration.php', $file);        

        echo "
            <script>
                alert('¡Muy bien! Ya has terminado esta parte de la instalación. Ahora CONSULTORIO puede comunicarse con tu base de datos. ¡Bienvenido!');
                window.location = 'index.php';
            </script>
        ";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalacion Hotel System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="icon" href="vistas/images/logo.png">
    <link rel="stylesheet" href="vistas/css/style.css">
</head>
<body style="background:#bdbdbd;background-image:url('views/images/bg.jpg');background-repeat: no-repeat;background-size: cover;"> 
    <div class='container' style="background-color:rgba(255,255,255,0.8);margin-top:50px;margin-bottom:50px;">
        
        <header style="padding-top:50px;">
            <h2 class='text-center d-block'><img src="vistas/images/logo.png" style="width:350px;"></h2>
            <span class='text-center d-block'>by <strong>Leonardo Fabián</strong></span>
        </header>    
        <div style="max-width:650px;margin:0 auto;padding:50px 0;">
            <section>
                <p>
                    Bienvenido a <strong>CONSULTORIO</strong>. Antes de empezar necesitamos alguna información de la base de datos. Necesitarás saber lo siguiente antes de continuar.
                </p>
                <br/>
                <hr>
                <section>                      
                    <p>
                    A continuación debes introducir los detalles de conexión de tu base de datos. Si no estás seguro 
                    de esta información contacta con tu proveedor de alojamiento web.
                    </p>                  
                    <form action="" method="post">                                                 
                        
                            <?= CoreController::generateInput_x('db_name', 'Nombre de la base de datos', 'text', 'Nombre sin espacios','','[A-Za-z0-9_]+','','db_name'); ?>
                            <?= CoreController::generateInput_x('db_user', 'Nombre de usuario', 'text', 'Nombre de usuario suministrado','','[A-Za-z0-9_]+','required','db_user'); ?>
                            <?= CoreController::generateInput_x('db_pass', 'Contraseña', 'password', 'Contraseña suministrada','','[A-Za-z0-9]+','','db_pass'); ?>
                            <?= CoreController::generateInput_x('db_host', 'Servidor de la base de datos', 'text', 'Ej.: localhost','','[A-Za-z0-9.]+','','db_host'); ?>
                            <hr>
                            <p>Ingrese las credenciales que desea utilizar para acceder como Administrador del sistema</p>
                            <?= CoreController::generateInput_x('admin_name', 'Nombre del Administrador', 'text', 'Ingrese su nombre','','[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+','required','admin_name'); ?>
                            <?= CoreController::generateInput_x('admin_lastname', 'Apellido del Administrador', 'text', 'Ingrese su apellido','','[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+','required','admin_lastname'); ?>
                            <?= CoreController::generateInput_x('admin_user', 'Usuario Administrador', 'text', 'Usuario Administrador','','[A-Za-z0-9_]+','required','admin_user'); ?>
                            <?= CoreController::generateInput_x('admin_pass', 'Contraseña Administrador', 'password', 'Contraseña Administrador','','[A-Za-z0-9]+','required','admin_pass'); ?>

                        <hr>     
                        <br/>           
                        <p>
                            Vamos a usar esta información para crear un archivo configuration.php. Si por alguna razón no funciona la 
                            creación automática de este archivo, no te preocupes. Todo lo que hace es rellenar la información de la 
                            base de datos en un archivo de configuración. También puedes, simplemente, abrir el archivo 
                            configuration.php en un editor de texto, rellenarlo con tu información y guardarlo en la carpeta modulos. 
                            ¿Necesitas más ayuda? La tenemos.

                            Es muy probable que estos elementos te los haya facilitado tu proveedor de alojamiento. Si no tienes 
                            esta información, tendrás que ponerte en contacto con ellos para poder continuar. Si ya estás listo…
                        </p>
                        <div class="form-group row">                            
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-lg btn-primary" id="btn-saveConfig">Configurar</button>                                
                            </div>
                        </div>
                        
                            

                        
                    </form>                    
                </section>
                
            </section>
        </div>

    </div>        
    
</body>
</html>