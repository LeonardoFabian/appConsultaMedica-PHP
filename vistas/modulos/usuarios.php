<?php

include 'menu.php';

?>

<div class="col-md-9">

    <div class="page-header bg-secondary">
      <img src="vistas/images/icons/user-md.svg" class="title-icon"/><h3>Usuarios</h3>        
    </div>  
   
    <div class="row pull-right" style="margin-bottom:30px;margin-top: 15px;">
            <div class="col-md-6">                
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar usuario
                </button>
            </div>        
        </div>
  
    <section class="listado col-md-12">
        <table class="table table-bordered table-striped dt-responsive my-datatable" width="100%">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>                    
                    <th>Rol</th>
                    <th>Estatus</th>
                    <th>Fecha Registro</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $item = null;
                $valor = null;
                $datos = UsuariosController::ctrRead($item, $valor);

                foreach($datos as $dato){

                  if($dato['id'] != 1){

                    echo "

                  <tr>
                      <td>{$dato['usuario']}</td>
                      <td class='text-uppercase'>{$dato['nombre']}"." "."{$dato['apellido']}</td>                   
                      <td>{$dato['rol']}</td>
                      <td>{$dato['estatus']}</td>
                      <td>{$dato['fecha_registro']}</td>
                      <td>
                      <div class='btn-group'>
                          <button class='btn btn-warning btnEditarUsuario' idUsuario='{$dato['id']}' data-toggle='modal' data-target='#modalEditarUsuario' style='margin-right:10px;'><i class='fa fa-pencil'></i></button>

                          <button class='btn btn-danger btnEliminarUsuario' idUsuarioEliminar='{$dato['id']} usuarioEliminar='{$dato['usuario']}'><i class='fa fa-times'></i></button>
                      </div>
                      </td>
                  </tr>                    
                  
                  ";

                  }
                }
            ?>
                
            </tbody>
        </table>
    </section> 

</div>

<!-- MODAL : Agregar usuario -->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar usuario</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              <!-- input nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg"  name="nuevo-nombre" placeholder="Nombre" maxlength="30" required>
                </div>
              </div>
              <!-- /input nombre -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg"  name="nuevo-apellido" placeholder="Apellido" maxlength="30" required>
                </div>
              </div>
              <!-- /input apellido -->
              <!-- input Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg"  id="nuevo-usuario" name="nuevo-usuario" placeholder="Usuario" maxlength="30" required>
                </div>
              </div>
              <!-- /input Usuario -->
              <!-- input Contraseña -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg"  name="nuevo-pass" placeholder="Contraseña" maxlength="30" required>
                </div>
              </div>
              <!-- /input Contraseña -->
              <!-- input Permisos -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select name="nuevo-rol" class="form-control input-lg">
                    <option value="">Seleccionar permisos</option>
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
            <button type="submit" class="btn btn-primary">Crear usuario</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $crearUsuario = new UsuariosController();
            $crearUsuario -> ctrCreate();

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
            <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-success btn-lg text-uppercase">Editar</button>
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