<?php

//include 'menu.php';

?>

<div class="col-lg-12" style="background: #B2DFDB;">

    <div class="container" >

    <!--
        <div class="alert alert-info">
            <div class="row">
                <div class="col-md-6">                               
                    <a href="crear-consulta">
                    <button class="btn btn-primary">
                        Crear consulta
                    </button> 
                    </a>               
                </div>        
            </div>
        </div>
    -->

        <div class="page-header-consulta" style="margin-bottom:15px;">
            <a href="consultas" title="Volver atrás" class="btn btn-primary btn-xs" style="font-size:20px;margin-right:16px;padding:10px 15px;"><i class="fa fa-arrow-left"></i></a>
            <h3 style="font-size:28px;color:#00796B;padding:15px 0;display:inline-block">Crear consulta</h3>        
        </div>   

        <section class="listado">
            
            <div class="row">
                <!-- formulario -->
                <div class="col-lg-5 col-xs-12" style="background: #FFFFFF;padding:25px;margin-bottom:100px;margin-right:30px;">
                    <div class="box box-success">
                        <div class="box-header with-border"></div>
                        <form role="form" method="post" class="formConsulta" id="formConsulta">
                        <div class="box-body">                            
                                <div class="box">
                                    <!-- Doctor -->
                                    <strong>Doctor:</strong>
                                    <div class="form-group">
                                        <div class="input-group">                                        
                                            <input type="text" class="form-control text-uppercase" id="nuevoDoctor" name="nuevoDoctor" value="<?php echo "Dr. " . $_SESSION["nombre"] ." ". $_SESSION["apellido"] ; ?>" readonly>
                                            <input type="hidden" id="idDoctor" name="idDoctor" value="<?php echo $_SESSION["id"] ; ?>" >
                                        </div>
                                    </div>
                                    <!-- codigo receta -->
                                    <strong>Receta No.:</strong>
                                    <div class="form-group">
                                        <div class="input-group">   
                                            <?php

                                                $item = null;
                                                $valor = null;
                                                $consultas = ConsultasController::ctrRead($item, $valor);

                                                if(!$consultas){
                                                    echo "<input type='text' class='form-control' id='nuevaReceta' name='nuevaReceta' value='1000001' readonly>";
                                                } else {

                                                    foreach($consultas as $key => $consulta){

                                                    }

                                                    $codigo = $consulta['codigo'] + 1;
                                                    echo "<input type='text' class='form-control' id='nuevaReceta' name='nuevaReceta' value='{$codigo}' readonly>";
                                                }
                                            
                                            ?>                                    
                                            
                                        </div>
                                    </div>
                                    <!-- paciente -->
                                    <strong>Paciente:</strong>
                                    <div class="form-group">
                                        <div class="input-group">                                        
                                            <select class="form-control" id="seleccionarPaciente" name="seleccionarPaciente" required>
                                                <option value="">Seleccionar paciente</option>
                                                <?php
                                                
                                                    $item = null;
                                                    $valor = null;
                                                    $pacientes = PacientesController::ctrRead($item, $valor);

                                                    foreach($pacientes as $key => $paciente){
                                                        echo "<option value='{$paciente['id']}'>{$paciente['cedula']}"." ".$paciente['nombre'] ." ". $paciente['apellido'] ."</option>";
                                                    }

                                                ?>
                                            </select>

                                            <span class="">
                                                <button title="Agregar paciente" type="button" class="btn btn-default" data-toggle="modal" data-target="#modalAgregarPaciente" data-dismiss="modal"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Tipo de servicio -->
                                    <strong>Tipo de servicio:</strong>
                                    <div class="form-group">
                                        <div class="input-group">                                        
                                            <select class="form-control seleccionarServicio" id="seleccionarServicio" name="seleccionarServicio" required>
                                                <option value="">Seleccionar servicio</option>
                                                <?php
                                                
                                                    $item = null;
                                                    $valor = null;
                                                    $servicios = ServiciosController::ctrRead($item, $valor);

                                                    foreach($servicios as $key => $servicio){
                                                        echo "<option value='{$servicio['id']}'>{$servicio['nombre']}</option>";
                                                    }

                                                ?>
                                            </select>

                                            <span class="">
                                                <button title="Agregar paciente" type="button" class="btn btn-default" data-toggle="modal" data-target="#modalAgregarPaciente" data-dismiss="modal"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <img src="vistas/images/icons/prescription.svg" style="width:25px;">
                                    <hr>
                                    <div class="form-group row nuevoMedicamento">
                                        <!-- descripcion medicamentos -->
                                        <!--
                                        <div class="col-xs-6" style="padding-right:0px;">
                                            <div class="input-group">
                                                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                                <input type="text" class="form-control" id="agregarMedicamento" name="agregarMedicamento" placeholder="Descripción del medicamento">
                                            </div>
                                        </div>
                                        -->
                                        <!-- cantidad medicamentos -->
                                        <!--
                                        <div class="col-xs-3">
                                            <input type="number" class="form-control" id="nuevaCantidadMedicamento" name="nuevaCantidadMedicamento" min="1" placeholder="0" required>
                                        </div>
                                        -->
                                        <!-- dosis medicamentos -->
                                        <!--
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" id="nuevaDosisMedicamento" name="nuevaDosisMedicamento" placeholder="Ej.: 1 vez al día" required>
                                        </div>
                                        -->
                                        <!-- precio medicamentos -->
                                        <!--
                                        <div class="col-xs-3" style="padding-left: 0px;">
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="number" class="form-control" id="nuevoPrecioMedicamento" name="nuevoPrecioMedicamento" min="1" placeholder="0000" readonly required>                                            
                                            </div>
                                        </div>
                                                -->
                                    </div>

                                    <!-- JSON lista de medicamentos -->
                                    <input type="hidden" id="listaMedicamentos" name="listaMedicamentos">

                                    <!-- boton agregar medicamento dispositivos moviles -->
                                    <button type="button" class="btn btn-default hidden-lg">Agregar medicamento</button>
                                    <hr>

                                    <!-- motivo consulta -->
                                    <strong>Motivo de consulta:</strong>
                                    <div class="form-group row nuevoMotivoConsulta">
                                        <div class="col-xs-12">
                                            <div class="input-group">                                                    
                                                <textarea class="form-control" id="detallesMotivoConsulta" name="detallesMotivoConsulta" placeholder="Motivo de la consulta"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- comentario -->
                                    <strong>Comentario:</strong>
                                    <div class="form-group row nuevoComentarioConsulta">
                                        <div class="col-xs-12">
                                            <div class="input-group">                                                    
                                                <textarea class="form-control" id="detallesComentarioConsulta" name="detallesComentarioConsulta" placeholder="Comentarios"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <!-- impuestos y total -->
                                        <div class="col-xs-10 pull-right">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Impuesto</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <!-- calcular impuesto -->
                                                        <td style="width: 50%;">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control text-center" min="0" id="nuevoImpuestoConsulta" name="nuevoImpuestoConsulta" placeholder="0">
                                                                <!-- total impuesto -->
                                                                <input type="hidden" class="form-control" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto" value="">
                                                                <!-- precio neto -->
                                                                <input type="hidden" class="form-control" id="nuevoPrecioNeto" name="nuevoPrecioNeto" value="">
                                                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                            </div>
                                                        </td>
                                                        <!-- total -->
                                                        <td style="width: 50%;">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">$</span>
                                                                <input type="text" class="form-control text-right" total="" id="nuevoTotalConsulta" name="nuevoTotalConsulta" value="" readonly required>                                                            
                                                                <input type="hidden" id="totalConsultaSinFormato" name="totalConsultaSinFormato" value="">     
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <hr>
                                    <!-- Metodo de pago -->

                                    <div class="form-group row">
                                        <div class="col-xs-6" id="divMetodoPago" style="padding-right:16px;">
                                            <strong>Metodo de pago</strong>
                                            <div class="input-group">
                                                <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" >
                                                    <option value="">Metodo de pago</option>
                                                    <option value="efectivo">Efectivo</option>
                                                    <option value="TC">Tarjeta Crédito</option>
                                                    <option value="TD">Tarjeta Débito</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Generar entrada metodo pago -->
                                        <div class="inputMetodoDePago"> <!-- consultas.js --> </div>

                                        <!-- listar metodo pago -->
                                        <input type="hidden" id="listaMetodoDePago" name="listaMetodoDePago"> <!-- consultas.js --> 

                                    </div>                                    

                                </div>
                            
                        </div>
                        <hr>
                        <div class="box-footer">                            
                            <button type="submit" class="btn btn-success btn-lg pull-right text-uppercase">Cuardar</button>
                        </div>
                        </form>

                        <?php 
                        
                            $estatus = 1;
                            $guardarConsulta = new ConsultasController();
                            $guardarConsulta -> ctrCreate($estatus);
                        
                        ?>

                    </div>
                </div>

                <!-- tabla de medicamentos -->
                <div class="col-lg-6 hidden-md hidden-sm hidden-xs pull-right" style="background: #FFFFFF;padding:20px;margin-bottom:100px;">
                    <div class="box box-warning">
                        <div class="box-header with-border"></div>
                        <div class="box-body">
                            <table id="consultaTablaProductos" class="consultaTablaProductos table table-bordered table-striped dt-responsive my-datatable" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Código</th>                    
                                        <th>Nombre Comercial</th>                                        
                                        <th>Presentación</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $item = null;
                                    $valor = null;
                                    $medicamentos = MedicamentosController::ctrRead($item, $valor);

                                    foreach($medicamentos as $key => $medicamento){

                                        echo "

                                        <tr>
                                            <td>". ($key+1) ."</td>
                                            <td>{$medicamento['codigo']}</td>                   
                                            <td>{$medicamento['nombreComercial']}</td>                                            
                                            <td>{$medicamento['presentacion']}</td>
                                            <td>
                                            <div class='btn-group pull-right'>
                                                <button class='btn btn-primary btnAgregarMedicamento activarBoton' idMedicamento='{$medicamento['id']}' data-toggle='modal' data-target='#modalEditarUsuario' style='margin-right:10px;'>Agregar</button>
                                            </div>
                                            </td>
                                        </tr>                    
                                        
                                        ";
                                    }
                                ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section> 

    </div>

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
            <button type="submit" class="btn btn-success">Crear paciente</button>
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

