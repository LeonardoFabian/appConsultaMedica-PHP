<?php

include 'menu.php';

?>

<div class="col-md-9">

    <div class="page-header bg-secondary">
      <img src="vistas/images/icons/briefcase-medical.svg" class="title-icon"/><h3>Servicios</h3>        
    </div>  

    
        <div class="row pull-right" style="margin-bottom:30px;margin-top: 15px;">
            <div class="col-md-6">                               
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalAgregarServicio">
                    Agregar servicio
                </button>                
            </div>        
        </div>
    

    <section class="listado col-md-12">
        <table class="table table-bordered table-striped dt-responsive my-datatable" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Servicio</th>    
                    <th>Costo</th>    
                    <th>Fecha de creacion</th>     
                    <th>Ultima modificación</th>          
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $item = null;
                $valor = null;
                $servicios = ServiciosController::ctrRead($item, $valor);

                foreach($servicios as $key => $servicio){                    

                    echo "

                    <tr>
                        <td>". ($key + 1)  ."</td>
                        <td class='text-uppercase'>{$servicio['nombre']}</td>        
                        <td>RD$ ".number_format($servicio['costo'],2)."</td>        
                        <td>{$servicio['fecha_creacion']}</td>  
                        <td>{$servicio['ultima_modificacion']}</td>                                          
                        <td>
                        <div class='btn-group'>
                            <button class='btn btn-warning btnEditarServicio' idServicio='{$servicio['id']}' data-toggle='modal' data-target='#modalEditarServicio' style='margin-right:10px;'><i class='fa fa-pencil'></i></button>

                            <button class='btn btn-danger btnEliminarServicio' idServicioEliminar='{$servicio['id']}'><i class='fa fa-times'></i></button>
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

<!-- MODAL : Registrar servicio  -->

<div id="modalAgregarServicio" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar servicio</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              
              <!-- input nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="nuevo-nombreServicio" name="nuevo-nombreServicio" placeholder="Nombre del servicio" required>
                </div>
              </div>
              <!-- /input nombre -->
              <!-- input costo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="number" class="form-control input-lg" id="nuevo-costoServicio" name="nuevo-costoServicio" placeholder="Costo del servicio" required>
                </div>
              </div>
              <!-- /input costo -->                          
                  
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary btn-lg text-uppercase">Agregar</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $crearServicio = new ServiciosController();
            $crearServicio -> ctrCreate();

        ?>      

        </form>
      <!-- /Modal content -->
      </div>
    </div>
  </div>



  <!-- MODAL : Editar servicio -->

<div id="modalEditarServicio" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        <!-- form Agregar usuario -->
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar servicio</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">

              <!-- input nombre -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editar-nombreServicio" name="editar-nombreServicio" placeholder="Nombre del servicio" required>
                  <input type="hidden" id="idServicioEditar" name="idServicioEditar" value="">
                </div>
              </div>
              <!-- /input nombre -->
              <!-- input costo -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="number" class="form-control input-lg" id="editar-costoServicio" name="editar-costoServicio" placeholder="Costo del servicio" required>
                </div>
              </div>
              <!-- /input costo -->     
              
              
            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-lg text-uppercase pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-success btn-lg text-uppercase">Editar</button>
          </div>
        <!-- /modal-footer -->    

        <?php

            $editarServicio = new ServiciosController();
            $editarServicio -> ctrUpdate();

        ?>      

        </form>
      <!-- /Modal content -->
      </div>
    </div>
  </div>


  

  <?php

  $eliminarServicio = new ServiciosController();
  $eliminarServicio -> ctrDelete();

  ?>