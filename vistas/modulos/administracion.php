<?php

include 'menu-administrar.php';

?>

<div class="col-md-9">

    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-6">                               
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarMedicamento">
                    Agregar servicio
                </button>
                
            </div>        
        </div>
    </div>

    <div class="page-header">
        <h3>Servicios</h3>        
    </div>   

    <section class="listado col-md-12">
        <table class="table table-bordered table-striped dt-responsive my-datatable" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>  
                    <th>Nombre</th>                    
                    <th>Principio Activo</th>
                    <th>Presentacion</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $item = null;
                $valor = null;
                $datos = MedicamentosController::ctrRead($item, $valor);

                foreach($datos as $key => $dato){

                    echo "

                    <tr>
                        <td>". ($key + 1)  ."</td>
                        <td>{$dato['codigo']}</td> 
                        <td>{$dato['nombreComercial']}</td>                   
                        <td>{$dato['principioActivo']}</td>
                        <td>{$dato['presentacion']}</td>
                        <td>{$dato['estatus']}</td>
                        <td>
                        <div class='btn-group'>
                            <button class='btn btn-warning btnEditarMedicamento' idMedicamento='{$dato['id']}' data-toggle='modal' data-target='#modalEditarMedicamento' style='margin-right:10px;'><i class='fa fa-pencil'></i></button>

                            <button class='btn btn-danger btnEliminarMedicamento' idMedicamentoEliminar='{$dato['id']}'><i class='fa fa-times'></i></button>
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

<!-- MODAL : Registrar medicamento  -->

<div id="modalRegistrarMedicamento" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar medicamento</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              <!-- input codigo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-codigoMedicamento" name="nuevo-codigoMedicamento" placeholder="Código" required>
                </div>
              </div>
              <!-- /input codigo -->
              <!-- input nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-nombreComercial" name="nuevo-nombreComercial" placeholder="Nombre comercial" required>
                </div>
              </div>
              <!-- /input nombre -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-principioActivo" name="nuevo-principioActivo" placeholder="Principio activo" required>
                </div>
              </div>
              <!-- /input apellido -->
              <!-- input Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg"  id="nuevo-presentacion" name="nuevo-presentacion" placeholder="Presentación" required>
                </div>
              </div>
              <!-- /input Usuario -->              
                  
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Registrar medicamento</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $crearMedicamento = new MedicamentosController();
            $crearMedicamento -> ctrCreate();

        ?>      

        </form>
      <!-- /Modal content -->
      </div>
    </div>
  </div>



  <!-- MODAL : Editar usuario -->

<div id="modalEditarMedicamento" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar medicamento</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              <!-- input codigo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-codigoMedicamento" name="editar-codigoMedicamento" placeholder="Código" required>
                </div>
              </div>
              <!-- /input codigo -->
              <!-- input nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg"  id="editar-nombreComercial" name="editar-nombreComercial" placeholder="Nombre comercial">
                </div>
              </div>
              <!-- /input nombre -->
              <!-- input nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-principioActivo" name="editar-principioActivo" placeholder="Principio activo" >
                </div>
              </div>
              <!-- /input nombre -->
              <!-- input apellido -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg"  id="editar-presentacion" name="editar-presentacion" placeholder="Presentación" >
                </div>
              </div>
              <!-- /input apellido -->             
              
              
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar medicamento</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $editarMedicamento = new MedicamentosController();
            $editarMedicamento -> ctrUpdate();

        ?>      

        </form>
      <!-- /Modal content -->
      </div>
    </div>
  </div>


  

  <?php

  $eliminarMedicamento = new MedicamentosController();
  $eliminarMedicamento -> ctrDelete();

  ?>