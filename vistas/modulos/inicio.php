<div class="col-md-12">

    <div class="row row-cards">

        <?php if($_SESSION['id'] == 1){ ?>
        <div class="col-md-3 text-center">
            <a href="usuarios" class="">
            <img src="vistas/images/icons/user-md.svg" class="icards btn btn-default"/>                 
                <br>
                <h2>Usuarios</h2>
            </a>
        </div>
        <?php } ?>

        <div class="col-md-3 text-center">
            <a href="pacientes" class="">
                <img src="vistas/images/icons/users.svg" class="icards btn btn-default"/>  
                <br>
                <h2>Pacientes</h2>
            </a>
        </div>
        <div class="col-md-3 text-center">
            <a href="citas" class="">
                <img src="vistas/images/icons/calendar-alt.svg" class="icards btn btn-default"/>  
                <br>
                <h2>Citas</h2>
            </a>
        </div>   
        <div class="col-md-3 text-center">
            <a href="consultas" class="">
                <img src="vistas/images/icons/laptop-medical.svg" class="icards btn btn-default"/>                
                <br>
                <h2>Consultas</h2>
            </a>
        </div>     
    </div>

    <div class="row row-cards">        
        <div class="col-md-3 text-center">
            <a href="medicamentos" class="">
                <img src="vistas/images/icons/pills.svg" class="icards btn btn-default"/>                      
                <br>
                <h2>Medicamentos</h2>
            </a>
        </div>
        <div class="col-md-3 text-center">
            <a href="reportes" class="">
                <img src="vistas/images/icons/notes-medical.svg" class="icards btn btn-default"/>     
                <br>
                <h2>Reportes</h2>
            </a>
        </div>    
        <div class="col-md-3 text-center">
            <a href="servicios" class="">
                <img src="vistas/images/icons/briefcase-medical.svg" class="icards btn btn-default"/>     
                <br>
                <h2>Servicios</h2>
            </a>
        </div>    
        <div class="col-md-3 text-center">
            <a href="logs" class="">
                <img src="vistas/images/icons/file-medical-alt.svg" class="icards btn btn-default"/>                
                <br>
                <h2>Logs</h2>
            </a>
        </div>    
    </div>

</div>