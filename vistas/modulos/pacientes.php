<?php

include 'menu.php';

?>

<div class="col-md-9">

    <div class="page-header bg-secondary">        
        <img src="vistas/images/icons/users.svg" class="title-icon"/><h3>Pacientes</h3>              
    </div>   

  
    <div class="row pull-right" style="margin-bottom:30px;margin-top: 15px;">
            <div class="col-md-6">                
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalAgregarPaciente">
                    Agregar paciente
                </button>
            </div>        
        </div>
  
    

    <section class="listado col-md-12">
        <table class="table table-bordered table-striped dt-responsive my-datatable" width="100%">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>                    
                    <th>Fecha de Nacimiento</th>
                    <th>Sangre</th>
                    <th>Teléfono</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $item = null;
                $valor = null;
                $datos = PacientesController::ctrRead($item, $valor);

                foreach($datos as $dato){

                    echo "

                    <tr>
                        <td>{$dato['cedula']}</td>
                        <td>{$dato['nombre']}"." "."{$dato['apellido']}</td>                   
                        <td>{$dato['fechaNacimiento']}</td>
                        <td>{$dato['tipoSanguineo']}</td>
                        <td>{$dato['telefono']}</td>
                        <td>
                        <div class='btn-group'>
                            <button title='Ver detalles' class='btn btn-primary btnVerDetallesPaciente' idPaciente='{$dato['id']}' style='margin-right:10px;'><i class='fa fa-pencil'></i></button>
                            <button title='Editar' class='btn btn-warning btnEditarPaciente' idPaciente='{$dato['id']}' data-toggle='modal' data-target='#modalEditarPaciente' style='margin-right:10px;'><i class='fa fa-pencil'></i></button>
                            <button title='Eliminar' class='btn btn-danger btnEliminarPaciente' idPacienteEliminar='{$dato['id']} pacienteCedula='{$dato['cedula']}'><i class='fa fa-times'></i></button>
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

<!-- MODAL : Agregar paciente -->

<div id="modalAgregarPaciente" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar Paciente</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              <!-- input cedula -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-cedula" name="nuevo-cedula" placeholder="Cédula" maxlength="11" required>
                </div>
              </div>
              <!-- /input cedula -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-paciente-nombre" name="nuevo-paciente-nombre" placeholder="Nombre" maxlength="50" required>
                </div>
              </div>
              <!-- /input apellido -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-paciente-apellido" name="nuevo-paciente-apellido" placeholder="Apellido" maxlength="50" required>
                </div>
              </div>
              <!-- /input apellido -->
              <!-- input fecha nacimiento -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" class="form-control input-lg"  id="nuevo-paciente-nacimiento" name="nuevo-paciente-nacimiento" placeholder="Fecha de nacimiento" maxlength="50" required>
                </div>
              </div>
              <!-- /input fecha nacimiento -->
              <!-- input grupo sanguineo -->
              <div class="form-group row">
                    <label for="nuevoPerfil" class="col-sm-4 col-form-label">Grupo sanguineo:</label>
                    <select class="form-control col-sm-7 pull-right" name="nuevo-paciente-gruposanguineo" name="nuevo-paciente-gruposanguineo" style="max-width:320px;margin-right:16px;">
                        <option value="">Seleccionar un grupo sanguineo</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>   
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>  
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>   
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>                                      
                    </select>
                </div>
              <!-- /input grupo sanguineo -->
             <!-- input telefono -->
             <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-paciente-telefono" name="nuevo-paciente-telefono" placeholder="Teléfono" maxlength="11" required>
                </div>
              </div>
              <!-- /input telefono -->        
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Crear paciente</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $crearPaciente = new PacientesController();
            $crearPaciente -> ctrCreate();

        ?>      

        </form>
      <!-- /Modal content -->
      </div>
    </div>
  </div>



  <!-- MODAL : Editar paciente -->

<div id="modalEditarPaciente" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Paciente</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              <!-- input cedula -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-cedula" name="editar-cedula" placeholder="Cédula" maxlength="11" readonly>
                </div>
              </div>
              <!-- /input cedula -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-paciente-nombre" name="editar-paciente-nombre" placeholder="Nombre" maxlength="50" required>
                </div>
              </div>
              <!-- /input apellido -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-paciente-apellido" name="editar-paciente-apellido" placeholder="Apellido" maxlength="50" required>
                </div>
              </div>
              <!-- /input apellido -->
              <!-- input fecha nacimiento -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control input-lg"  id="editar-paciente-nacimiento" name="editar-paciente-nacimiento" placeholder="Fecha de nacimiento" maxlength="50" required>
                </div>
              </div>
              <!-- /input fecha nacimiento -->
              <!-- input grupo sanguineo -->
              <div class="form-group row">
                    <label for="nuevoPerfil" class="col-sm-4 col-form-label">Grupo sanguineo:</label>
                    <select class="form-control col-sm-7 pull-right" name="editar-paciente-gruposanguineo" name="nuevo-paciente-gruposanguineo" style="max-width:320px;margin-right:16px;">
                        <option value="" id="editar-paciente-gruposanguineo">Seleccionar un grupo sanguineo</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>   
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>  
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>   
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>                                      
                    </select>
                </div>
              <!-- /input grupo sanguineo -->
             <!-- input telefono -->
             <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-paciente-telefono" name="editar-paciente-telefono" placeholder="Teléfono" maxlength="11" required>
                </div>
              </div>
              <!-- /input telefono -->        
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar paciente</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $editarPaciente = new PacientesController();
            $editarPaciente -> ctrUpdate();

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