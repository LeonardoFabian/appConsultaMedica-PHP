<?php

require_once "../../../../controladores/consultas.controller.php";
require_once "../../../../controladores/pacientes.controller.php";
require_once "../../../../controladores/usuarios.controller.php";
require_once "../../../../controladores/medicamentos.controller.php";

require_once "../../../../modelos/consultas.model.php";
require_once "../../../../modelos/pacientes.model.php";
require_once "../../../../modelos/usuarios.model.php";
require_once "../../../../modelos/medicamentos.model.php";



class imprimirReceta {

public $codigo;

public function traerImpresionReceta(){

// DATOS CONSULTA
$item = "codigo";
$valor = $_GET['codigoReceta'];
$datos = ConsultasController::ctrRead($item, $valor);

// datos de la receta
$fecha = substr($datos['fecha'], 0, -8);
$medicamentos = json_decode($datos['medicamentos'], true);
$neto = number_format($datos['neto'], 2);
$impuesto = number_format($datos['impuesto'], 2);
$total = number_format($datos['total'], 2);

// DATOS DEL PACIENTE
$itemPaciente = "id";
$valorPaciente = $datos['paciente_id'];
$paciente = PacientesController::ctrRead($itemPaciente, $valorPaciente);

// DATOS DOCTOR
$itemDoctor = "id";
$valorDoctor = $datos['usuario_id'];
$doctor = UsuariosController::ctrRead($itemDoctor, $valorDoctor);

// DOCUMENTO PDF

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//iniciar grupo de paginas
$pdf->startPageGroup();

//adicionar una nueva pagina
$pdf->AddPage();


// MAQUETACION

//-----------------------------------------------------------------------------
$bloque1 = <<<EOF

    <table>

        <tr>

            <td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

            <td style="background-color:white; width:280px"></td>           

            <td style="background-color:white; width:110px; text-align:right; color:red">                

                <br><br><span>RECETA No.:</span><br> 
                
                $datos[codigo]

                <br>                                           
            
            </td>            

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ----------------------------------------------------------------


$bloque2 = <<<EOF

    <table>

        <tr>           

            <td style="background-color:white; width:140px">

                <div style="font-size:8.5px; text-align:left; line-height:15px;">

                    <br>
                    RNC: 000-00000-0

                    <br>
                    C/Nombre de la calle No.0

                </div>                
            
            </td>

            <td style="background-color:white; width:140px">

                <div style="font-size:8.5px; text-align:left; line-height:15px;">

                    <br>
                    Tel.: 829-322-4973

                    <br>
                    info@consulta.do

                </div>                
            
            </td>         
            

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ----------------------------------------------------------------

$bloque3 = <<<EOF

    <table>

        <tr>

            <td style="width:540px"><img src="images/back.jpg"></td>

        </tr>
    
    </table>

    <table style="font-size:10px; padding: 5px 10px;">

        <tr>            

            <td style="border:1px solid #666; background-color:white; width:390px">

                Paciente: $paciente[nombre] $paciente[apellido]               
            
            </td>

            <td style="border:1px solid #666; background-color:white; width:150px; text-align:right;">

                Fecha: $fecha               
            
            </td>                       

        </tr>

        <tr>

            <td style="border:1px solid #666; background-color:white; width:540px">

                Doctor: <span style="text-transform: uppercase">$doctor[nombre] $doctor[apellido]</span>                 
            
            </td>
        
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ----------------------------------------------------------------

$bloque4 = <<<EOF

    <table>

        <tr>

            <td style="width:540px"><img src="images/back.jpg"></td>

        </tr>
    
    </table>

    <table style="font-size:10px; padding: 5px 10px;">

        <tr>            

            <th style="border:1px solid #666; background-color:white; width:70px; text-align: center">Cantidad</th>
            <th style="border:1px solid #666; background-color:white; width:260px; text-align: center">Medicamento</th>
            <th style="border:1px solid #666; background-color:white; width:100px; text-align: center">Presentacion</th>
            <th style="border:1px solid #666; background-color:white; width:110px; text-align: center">Dosis</th>                

        </tr>       

    </table>    

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

// ----------------------------------------------------------------

foreach ($medicamentos as $key => $medicamento){

$itemMedicamento = "nombreComercial";
$valorMedicamento = $medicamento["descripcion"];

$datos = MedicamentosController::ctrRead($itemMedicamento, $valorMedicamento);


$bloque5 = <<<EOF
   
    <table style="font-size:10px; padding: 5px 10px;">

        <tr>            

            <th style="border:1px solid #666; background-color:white; width:70px; text-align: center">$medicamento[cantidad]</th>
            <th style="border:1px solid #666; background-color:white; width:260px; text-align: center"><span style="text-transform:uppercase;">$medicamento[descripcion]</span></th>
            <th style="border:1px solid #666; background-color:white; width:100px; text-align: center"><span style="text-transform:uppercase;">$medicamento[presentacion]</span></th>
            <th style="border:1px solid #666; background-color:white; width:110px; text-align: center"><span style="text-transform:uppercase;">$medicamento[dosis]</span></th>                

        </tr>       

    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

} // end foreach

// ----------------------------------------------------------------

$bloque6 = <<<EOF
       
    <table style="font-size:10px; padding: 5px 10px;">

        <tr>    
            
            <td style="width:330px; style="color:#333; background-color:white; text-align: center;""></td>

            <td style="border-bottom:1px solid #666; background-color:white; width:100px; text-align: center"></td>                           

            <td style="border-bottom:1px solid #666; background-color:white; width:110px; text-align: center"></td> 

        </tr>

        <tr>

            <td style="border-right:1px solid #666; color:#333; background-color:white; width:330px; text-align: center"></td>

            <td style="border: 1px solid #666; background-color:white; width:100px; text-align: center">Neto:</td>

            <td style="border: 1px solid #666;  color:#333; background-color:white; width:110px; text-align: center">$neto</td>

        </tr>

        <tr>

            <td style="border-right:1px solid #666; color:#333; background-color:white; width:330px; text-align: center"></td>

            <td style="border: 1px solid #666; background-color:white; width:100px; text-align: center">Impuesto:</td>

            <td style="border: 1px solid #666;  color:#333; background-color:white; width:110px; text-align: center">$impuesto</td>

        </tr>

        <tr>

            <td style="border-right:1px solid #666; color:#333; background-color:white; width:330px; text-align: center"></td>

            <td style="border: 1px solid #666; background-color:white; width:100px; text-align: center">TOTAL:</td>

            <td style="border: 1px solid #666;  color:#333; background-color:white; width:110px; text-align: center">RD$$total</td>

        </tr>       

    </table>

    

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

// ----------------------------------------------------------------



// SALIDA DE ARCHIVO
$pdf->Output('receta'.$_GET['codigoReceta'].'.pdf');


}

}

$receta = new imprimirReceta();
$receta -> codigo = $_GET['codigoReceta'];
$receta -> traerImpresionReceta();

?>