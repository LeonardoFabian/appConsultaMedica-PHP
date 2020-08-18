<?php

include 'menu.php';

?>

<div class="col-md-9">

    <div class="page-header bg-secondary">
      <img src="vistas/images/icons/calendar-alt.svg" class="title-icon"/><h3>Citas</h3>        
    </div>  

    <div class="row pull-right" style="margin-bottom:30px;margin-top: 15px;">
            <div class="col-md-6">                               
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalRegistrarCita">
                    Nueva cita
                </button>
                
            </div>        
        </div>     

    <section class="listado col-md-12">
        <table class="table table-bordered table-striped dt-responsive my-datatable" width="100%">
            <thead>
                <tr>
                    <th>Fecha</th>                    
                    <th>Paciente</th>                    
                    <th>Doctor</th>                                   
                    <th>Hora Inicio</th>
                    <th>Hora Término</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $item = null;
                $valor = null;
                $datos = CitasController::ctrRead($item, $valor);

                foreach($datos as $dato){

                    $item = "id";
                    $valor = $dato['paciente_id'];
                    $paciente = PacientesController::ctrRead($item, $valor);

                    $item = "id";
                    $valor = $dato['usuario_id'];
                    $doctor = UsuariosController::ctrRead($item, $valor);

                    echo "

                    <tr>
                        <td>{$dato['dia']}</td>                         
                        <td>{$paciente['nombre']}"." "."{$paciente['apellido']}</td>               
                        <td class='text-uppercase'>{$doctor['nombre']}"." "."{$doctor['apellido']}</td>                          
                        <td>{$dato['horaInicio']}</td>
                        <td>{$dato['horaTermino']}</td> 
                        <td>
                        <div class='btn-group'>
                            <button class='btn btn-warning btnEditarCita' idCita='{$dato['id']}' data-toggle='modal' data-target='#modalEditarCita' style='margin-right:10px;'><i class='fa fa-pencil'></i></button>

                            <button class='btn btn-danger btnEliminarCita' idCitaEliminar='{$dato['id']}'><i class='fa fa-times'></i></button>
                        </div>
                        </td>
                    </tr>                    
                    
                    ";
                }
            ?>
                
            </tbody>
        </table>
    </section> 

</div>

<!-- MODAL : Registrar consulta -->

<div id="modalRegistrarCita" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registrar Cita</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              <!-- input cedula -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="cedula-paciente" name="cedula-paciente" placeholder="Cédula" maxlength="11" required>
                  <input type="hidden" class="form-control input-lg" id="id-paciente" name="id-paciente" value="">
                  <input type="hidden" class="form-control input-lg" id="id-usuario" name="id-usuario" value="<?php echo $_SESSION['id'] ?>">
                </div>
              </div>
              <!-- /input cedula -->

              <div class="form-group">
              <div class="input-group" style="width:100%;">
                  <select class="form-control" id="seleccionarDoctor" name="seleccionarDoctor" style="padding:8px;">
                      <option value="">Seleccione un Doctor</option>
                      
                      <?php 

                          $tabla = "usuarios";                         
                          $valor = "Doctor";
                          $datos = UsuariosModel::mdlReadDoctores($tabla, $valor);

                          foreach($datos as $key => $doctor){

                            echo "<option value='{$doctor['id']}'>{$doctor['nombre']} {$doctor['apellido']}</option>";

                          }

                      ?>

                  </select>
              </div>
              </div>

              <!-- input fecha cita -->
              <div class="form-group">
              <label for="fecha-cita">Dia de la cita:</label>
                <div class="input-group">                  
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control input-lg"  id="agendar-fecha-cita" name="agendar-fecha-cita" required>
                  <input type="hidden" id="fechasCitas" name="fechasCitas" required>
                </div>
              </div>
              <!-- /input fecha cita -->
              <!-- input hora inicio -->
              <div class="form-group col-md-6">
              <label for="hora-inicio">Desde:</label>
                <div class="input-group">                  
                  <span class="input-group-addon"><i class="fa fa-time"></i></span>
                  <input type="time" class="form-control input-lg"  id="hora-inicio" name="hora-inicio" required>
                </div>
              </div>
              <!-- /input hora inicio -->   
              <!-- input hora fin -->
              <div class="form-group col-md-6">
              <label for="hora-termino">Hasta:</label>
                <div class="input-group">                  
                  <span class="input-group-addon"><i class="fa fa-time"></i></span>
                  <input type="time" class="form-control input-lg"  id="hora-termino" name="hora-termino" required>
                </div>
              </div>
              <!-- /input hora fin -->   
              <div class="form-group col-md-6">
              <label for="comparar">Hasta:</label>
                <div class="input-group">                                  
                  <div style="display: none" class="alert alert-danger"  id="comparar" name="comparar" >Tiene una cita pendiente a esta hora</div>
                </div>
              </div>
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Reservar cita</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $crearCita = new CitasController();
            $crearCita -> ctrCreate();

        ?>      

        </form>
      <!-- /Modal content -->
      </div>
    </div>
  </div>



  <!-- MODAL : Editar usuario -->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar usuario</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              <!-- input Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg"  id="editar-usuario" name="editar-usuario" placeholder="Usuario" maxlength="30" readonly>
                </div>
              </div>
              <!-- /input Usuario -->
              <!-- input nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-nombre" name="editar-nombre" placeholder="Nombre" maxlength="30" >
                </div>
              </div>
              <!-- /input nombre -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg"  id="editar-apellido" name="editar-apellido" placeholder="Apellido" maxlength="30" >
                </div>
              </div>
              <!-- /input apellido -->              
              <!-- input Contraseña -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" id="editar-pass" name="editar-pass" placeholder="Contraseña" maxlength="30" >
                  <input type="hidden" class="form-control input-lg" id="pass-actual" name="pass-actual" >
                </div>
              </div>
              <!-- /input Contraseña -->
              <!-- input Permisos -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select name="editar-rol" class="form-control input-lg">
                    <option value="" id="editar-rol">Seleccionar permisos</option>
                    <option value="Doctor">Doctor</option>    
                    <option value="Asistente">Asistente</option>                                     
                  </select>
                </div>
              </div>
              <!-- /input Permisos -->              
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar usuario</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $editarUsuario = new UsuariosController();
            $editarUsuario -> ctrUpdate();

        ?>      

        </form>
      <!-- /Modal content -->
      </div>
    </div>
  </div>


  

  <?php

  $eliminarUsuario = new UsuariosController();
  $eliminarUsuario -> ctrDelete();

  ?>