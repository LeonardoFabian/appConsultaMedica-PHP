<div class="col-md-2">
  <!-- Left side column. contains the sidebar -->
<aside role="complementary" class="page-sidebar " style=>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">      
     
      <ul>

        <li class="active">
          <a href="inicio" class="btn btn-md">            
            <span>Inicio</span>
          </a>
        </li>		        
        <hr>
        <?php if($_SESSION['id'] == 1){ ?>
        <li class="">
          <a href="usuarios" class="btn btn-md">            
            <span>Usuarios</span>
          </a>
        </li>		
        <hr>
        <?php } ?>
        <?php if($_SESSION['id'] == 1 || $_SESSION['rol'] == "Asistente"){ ?>
        <li class="">
          <a href="pacientes" class="btn btn-md">            
            <span>Pacientes</span>
          </a>
        </li>	
        <hr>
        <?php } ?>
        <li class="">
          <a href="citas" class="btn btn-md">            
            <span>Citas</span>
          </a>
        </li>	
        <hr>        
        <li class="">
          <a href="consultas" class="btn btn-md">            
            <span>Consultas</span>
          </a>
        </li>	 
        <hr>        
        <li class="">
          <a href="medicamentos" class="btn btn-md">            
            <span>Medicamentos</span>
          </a>
        </li>   
        <hr>        
        <?php if($_SESSION['id'] == 1){ ?>   
        <li class="">
          <a href="servicios" class="btn btn-md">            
            <span>Servicios</span>
          </a>
        </li>  
        <hr>            
        <li class="">
          <a href="reportes" class="btn btn-md">            
            <span>Reportes</span>
          </a>
        </li>  
        <?php } ?>

      </ul>
      
    </section>
    <!-- /.sidebar -->
  </aside>

</div>