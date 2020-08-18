<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- login bootstrap -->
    
	<link rel="stylesheet" href="vistas/css/login.css">
	
</head>
<body>
    <div class="login-panel">	
							
		<div class="white-panel">
			<form action="" method="post">
            <div class="login-show">
                <div class="text-center">
                    <img src="vistas/images/logo.png" width="250px">
                </div>
                <div class="text-center">
                    <h4>Ingreso al Sistema</h4>
                </div>
                <hr>				
				<input type="text" class="form-control" placeholder="Usuario" name="ingUsuario">
				<input type="password" class="form-control" placeholder="Contraseña" name="ingPassword">
				<div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg" value="Iniciar sesión">Iniciar sesión</button>
                </div>				
            </div>
           
            <?php 

                $login = new LoginController();
                $login -> ctrIngresoUsuario();

            ?>
            </form>		            	
        </div>       

        
    </div>	
    
        
    
</body>
</html>