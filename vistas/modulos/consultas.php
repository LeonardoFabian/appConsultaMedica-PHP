<?php

include 'menu.php';

?>

<div class="col-md-9">

    <div class="page-header bg-secondary">
      <img src="vistas/images/icons/laptop-medical.svg" class="title-icon"/>  <h3>Consultas</h3>        
    </div> 
    
        <div class="row pull-right" style="margin-bottom:25px;margin-top: 5px;">
            <div class="col-md-6">                               
                <a href="crear-consulta">
                  <button class="btn btn-success btn-lg bg-success">
                      Crear consulta
                  </button> 
                </a>               
            </div>               
        </div>
      
        <section class="col-md-12" style="border-top:1px solid #bdbdbd; padding: 5px 0;">                     
          <button type="button" class="btn btn-default btn-lg" id="daterange-btn">
            <span>
                <i class="fa fa-calendar" style="margin-right:10px;"></i>Rango de fecha
            </span>
              <i class="fa fa-caret-down"></i>
          </button>                    
        </section> 
      

    <section class="listado col-md-12">
        <table class="table table-bordered table-striped dt-responsive my-datatable" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th> 
                    <th>Código</th>                                     
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Ultima consulta</th>                             
                    <th>Estatus</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>

            <?php

              if(isset($_GET["fechaInicial"])){

                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal = $_GET["fechaFinal"];

              }

                $item = null;
                $valor = null;
                $consultas = ConsultasController::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
                //$consultas = ConsultasController::ctrRead($item, $valor);

                //var_dump($consultas);

                foreach($consultas as $key => $consulta){

                    $item = "id";
                    $valor = $consulta['paciente_id'];
                    $paciente = PacientesController::ctrRead($item, $valor);

                    //var_dump($paciente);

                    $item = "id";
                    $valor = $consulta['usuario_id'];
                    $usuario = UsuariosController::ctrRead($item, $valor);

                    $item = "id";
                    $valor = $consulta['servicio_id'];
                    $servicio = ServiciosController::ctrRead($item, $valor);

                    echo "

                    <tr>
                        <td>". ($key + 1) ."</td>
                        <td>{$consulta['fecha']}</td>
                        <td>{$consulta['codigo']}</td>                        
                        <td>{$paciente['nombre']}"." "."{$paciente['apellido']}</td>                   
                        <td class='text-uppercase'>{$usuario['nombre']}"." "."{$usuario['apellido']}</td>  
                        <td>{$paciente['ultima_consulta']}</td>                            
                        <td class='text-center'>";

                        if($consulta['estatus_pago'] == 0){
                          echo "<button title='Consulta por Cobrar' class='btn btn-danger btn-xs' idConsulta='{$consulta['id']}' style='margin-top:5px;'>POR COBRAR</button>";
                        } else {
                          echo "<button title='Pago realizado' class='btn btn-warning btn-xs' idConsulta='{$consulta['id']}' style='margin-top:5px;'>PAGADA</i></button>";
                        }  

                    echo "</td>                        
                        <td class='text-center'>
                        <div class='btn-group'>
                        ";

                        if($consulta['estatus_pago'] == 0){
                          echo "<button title='Pagar consulta' class='btn btn-primary btnPagarConsulta' idConsultaPagar='{$consulta['id']}' data-toggle='modal' data-target='#modalPagarConsulta' style='margin-right:10px;'><i class='fa fa-usd'></i></button>";
                        } else {
                          echo "<button title='Imprimir receta' class='btn btn-info btnImprimirReceta' idRecetaImprimir='{$consulta['id']}' codigoReceta='{$consulta['codigo']}' data-toggle='modal' data-target='#modalImprimirReceta' style='margin-right:10px;'>
                          <i class='fa fa-print'></i>
                          </button>";
                        }                         
                            
                    echo "</div>
                        </td>
                    </tr>                    
                    
                    ";
                }
            ?>
                
            </tbody>
        </table>
    </section> 

</div>




<!-- MODAL : PAGAR CONSULTA -->

<div id="modalPagarConsulta" class="modal fade" role="dialog" style="margin-bottom:60px;">
    <div class="modal-dialog">
      <!-- Modal content -->
      <div class="modal-content">
        
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Pagar Consulta</h4>
          </div>
          <!-- /modal-header -->
          <div class="modal-body">
            <div class="box-body">
              


                <!-- VISTA CONSULTA -->
            
                <section class="listado">
            
            <div class="row">
                <!-- formulario -->
                <div class="col-lg-12 col-xs-12" style="background: #FFFFFF;padding:25px;margin-bottom:100px;margin-right:30px;">
                    <div class="box box-success">
                        <div class="box-header with-border">Pagar consulta</div>
                        <form role="form" method="post" class="formConsulta" id="formConsulta">
                        <div class="box-body">                            
                                <div class="box">
                                    <!-- Doctor -->
                                    <strong>Doctor:</strong>
                                    <div class="form-group">
                                        <div class="input-group">                                        
                                            <input type="text" class="form-control text-uppercase" id="consultaDoctor" name="consultaDoctor" value="" readonly>                                           
                                        </div>
                                    </div>
                                    <!-- codigo receta -->
                                    <strong>Receta No.:</strong>
                                    <div class="form-group">
                                        <div class="input-group">                                          
                                               
                                           <input type='text' class='form-control' id='consultaReceta' name='consultaReceta' value='' readonly>                                                                                       
                                           
                                        </div>
                                    </div>
                                    <!-- paciente -->
                                    <strong>Paciente:</strong>
                                    <div class="form-group">
                                        <div class="input-group">                                                                                  
                                            <input type='text' class='form-control' id='consultaPaciente' name='consultaPaciente' value='' readonly>
                                        </div>
                                    </div>

                                    <!-- Tipo de servicio -->
                                    <strong>Tipo de servicio:</strong>
                                    <div class="form-group">
                                        <div class="input-group">                                                                                 
                                          <input type='text' class='form-control' id='consultaServicio' name='consultaServicio' value='' readonly>
                                        </div>
                                    </div>
                                    
                                  
                                    <hr>
                                    <div class="form-group row nuevoMedicamento">
                                      <div class="col-lg-12 col-xs-12">
                                        <input type='text' class='form-control' id='consultaMedicamentos' name='consultaMedicamentos' value='' readonly>
                                        </div>
                                      </div>                                                                    

                                    <!-- motivo consulta -->
                                    <strong>Motivo de consulta:</strong>
                                    <div class="form-group row nuevoMotivoConsulta">
                                        <div class="col-lg-12 col-xs-12">
                                            <div class="input-group">                                                    
                                                <textarea class="form-control" id="detallesMotivoConsulta" name="detallesMotivoConsulta" placeholder="Motivo de la consulta" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- comentario -->
                                    <strong>Comentario:</strong>
                                    <div class="form-group row nuevoComentarioConsulta">
                                        <div class="col-lg-12 col-xs-12">
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
                            <button type="submit" class="btn btn-primary btn-lg pull-right text-uppercase">Pagar</button>
                        </div>
                        </form>

                        <?php 
                        
                            $estatus = 0;
                            $guardarConsulta = new ConsultasController();
                            $guardarConsulta -> ctrCreate($estatus);
                        
                        ?>

                    </div>
                </div>                
            </div>

        </section> 

                <!-- /VISTA CONSULTA -->


            </div>
            <!-- box-body -->
          </div>
          <!-- /modal-body -->             
       
      <!-- /Modal content -->
      </div>
    </div>
  </div>

