<header id="header" class="bg-secondary">
    <div class="container-fluid">
        <div class="col-md-12">
        <div class="col-md-6">
            <div class="navbar-header">
                <a href="inicio">
                    <img src="vistas/images/logo.svg" id="img-logo"/>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="nav navbar-nav navbar-right" >
                    <span>Bienvenido 
                        <?php 
                            if($_SESSION['rol'] == "Doctor"){
                                echo "<strong style='text-transform:uppercase;'>Dr. {$_SESSION['usuario']}</strong>"; 
                            } else {
                            echo "<strong style='text-transform:uppercase;'>{$_SESSION['usuario']}</strong>"; 
                            }
                        ?>
                    </span>
                    <span class="btn dropdown-toggle" type="button" data-toggle="dropdown" style="margin-left:10px;border:none;">
                    <img src="vistas/images/icons/menu-icon.svg" style="width:30px;"/>
                </span>
                <ul class="dropdown-menu">                
                    <li>
                        <a href="salir" class="btn btn-default btn-flat btn-lg">Salir</a>
                    </li>            
                </ul>
            </div>
        </div>
        </div>
    </div>    
</header>
