if(localStorage.getItem("capturarRango") != null){

    $("#daterange-btn span").html(localStorage.getItem("capturarRango"));

} else {

    $("#daterange-btn span").html("<i class='fa fa-calendar' style='margin-right:10px;'></i> Rango de fecha");

}


// Agregar medicamento a la receta

$(".btnAgregarMedicamento").click(function(){
    
    var idMedicamento = $(this).attr("idMedicamento");
    //console.log("id", idMedicamento);

    $(this).removeClass("btn-primary btnAgregarMedicamento");

    $(this).addClass("btn-deafult");

    $(this).prop('disabled', true);

    let datos = new FormData();
    datos.append("idMedicamento", idMedicamento);

    $.ajax({
        url: "ajax/medicamentos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta", respuesta);

            var descripcion = respuesta['nombreComercial'];
            var presentacion = respuesta['presentacion'];

            $(".nuevoMedicamento").append(            
            
                '<div class="row" style="padding:5px 15px;">'+

                    '<!-- cantidad medicamentos -->' +
                    
                    '<div class="col-xs-3">' +
                        '<input type="number" class="form-control nuevaCantidadMedicamento" name="nuevaCantidadMedicamento" min="1" value="1" required>' +
                    '</div>' +

                    '<div class="col-xs-9" style="padding-left:0px;">' +
                        '<div class="input-group">' +                            
                            '<input type="text" class="form-control agregarMedicamento nuevaDescripcionMedicamento" idMedicamento="'+idMedicamento+'" name="agregarMedicamento" value="'+descripcion+'" readonly>' +
                            '<button type="button" class="btn btn-danger quitarMedicamentoDeLista" idMedicamento="'+idMedicamento+'"><i class="fa fa-times"></i></button>' +
                        '</div>' +
                    '</div>' +

                    '<br/>'+
                    
                    '<!-- presentacion medicamentos -->' +                    
                    '<div class="col-xs-9 pull-right" style="padding-left:0px;">' +
                        '<input type="text" class="form-control nuevaPresentacionMedicamento" name="nuevaPresentacionMedicamento" value="'+presentacion+'" readonly>' +
                    '</div>'+
                    
                    '<br/>'+
                    
                    '<!-- dosis medicamentos -->' +                    
                    '<div class="col-xs-9 pull-right" style="padding-left:0px;">' +
                        '<input type="text" class="form-control nuevaDosisMedicamento" name="nuevaDosisMedicamento" placeholder="Ej.: 1 vez al día" >' +
                    '</div>'+
                '</div>'                      
            
            );                
            
            listarMedicamentos()
        }
    });
});


// cuando haga paginacion en la tabla TO DO: VERSION 2.0
/*
$(".consultaTablaProductos").on("draw.dt", function(){
    //console.log("tabla");
    if(localStorage.getItem("quitarMedicamento") != null){
        var listaMedicamentos = JSON.parse(localStorage.getItem("quitarMedicamento"));

        for(var i = 0; i < listaMedicamentos.length; i++){
            $("button.activarBoton[idMedicamento='"+listaMedicamentos[i]["idMedicamento"]+"']").removeClass("btn-default");
            $("button.activarBoton[idMedicamento='"+listaMedicamentos[i]["idMedicamento"]+"']").addClass("btn-primary btnAgregarMedicamento");
            $("button.activarBoton[idMedicamento='"+listaMedicamentos[i]["idMedicamento"]+"']").prop('disabled', false);
        }
    }
});
*/

// Quitar medicamento de la receta y activar boton de agregar

// var idQuitarMedicamento = [];  //TODO: Habilitar con version 2.0
// localStorage.removeItem("quitarMedicamento");

$(".formConsulta").on("click", "button.quitarMedicamentoDeLista", function(){

    $(this).parent().parent().parent().remove();
    var idMedicamento = $(this).attr("idMedicamento");

    // almacenar el id del medicamento a quitar en el local storage TO DO: VERSION 2.0
    /*
    if(localStorage.getItem("quitarMedicamento") == null){
        idQuitarMedicamento = [];        
    } else {
        idQuitarMedicamento.concat(localStorage.getItem("quitarMedicamento"));
    }
    
    idQuitarMedicamento.push({"idMedicamento":idMedicamento});
    localStorage.setItem("quitarMedicamento", JSON.stringify(idQuitarMedicamento));
    */

    $("button.activarBoton[idMedicamento='"+idMedicamento+"']").removeClass('btn-default');
    $("button.activarBoton[idMedicamento='"+idMedicamento+"']").addClass('btn-primary btnAgregarMedicamento');
    $("button.activarBoton[idMedicamento='"+idMedicamento+"']").prop('disabled', false);

    listarMedicamentos()

});


// Cargar precio del servicio

$("#seleccionarServicio").change(function(){

    $("#nuevoTotalConsulta").val(''); 
    $("#totalConsultaSinFormato").val(''); 
    $("#nuevoTotalConsulta").attr("total", 0);  
    $("#nuevoImpuestoConsulta").val(0); 

    var idServicio = $(this).val();
    //console.log("id",idServicio);

    var fdata = new FormData();
	fdata.append("idServicio", idServicio);

	$.ajax({

		url: "ajax/servicios.ajax.php",
		method: "POST",
		data: fdata,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(result){

			//console.log("result", result);
			
			if(result){

                $("#totalConsultaSinFormato").val(result['costo']); 
                $("#nuevoTotalConsulta").val(result['costo']);                 
                $("#nuevoTotalConsulta").attr("total", result['costo']);   
                $("#nuevoImpuestoConsulta").val(0);                    
                
			} 

		}
    });
    
    listarMedicamentos()

});


// Agregar impuesto

$("#nuevoImpuestoConsulta").on("change",function(){

    var impuesto = $("#nuevoImpuestoConsulta").val();
    var precioTotal = $("#nuevoTotalConsulta").attr("total");

    var precioImpuesto = Number(precioTotal * impuesto / 100);

    var totalConimpuesto = Number(precioImpuesto) + Number(precioTotal);

    $("#nuevoTotalConsulta").val(totalConimpuesto);
    $("#nuevoPrecioImpuesto").val(precioImpuesto);
    $("#nuevoPrecioNeto").val(precioTotal);

    // almacenar costo sin formato
    $("#totalConsultaSinFormato").val(totalConimpuesto); 

    $("#nuevoTotalConsulta").number( true, 2 );
    

});



// Seleccionar metodo de pago

$("#nuevoMetodoPago").change(function(){      

    var metodo = $(this).val();

    if(metodo == "efectivo"){
        // Reducir tamaño div pago efectivo
        $("#divMetodoPago").removeClass("col-xs-6");
        $("#divMetodoPago").addClass("col-xs-4");

        $(this).parent().parent().parent().children(".inputMetodoDePago").html(
            '<div class="col-xs-4">'+
                '<strong>Recibido</strong>'+
                '<div class="input-group">'+
                    '<span class="input-group-addon">$</span>'+  
                    '<input type="text" class="form-control nuevoEfectivoRecibido" placeholder="0.00" val="" >'+                                  
                '</div>'+
            '</div>'+
            
            '<div class="col-xs-4 capturarCambioEfectivo">'+
                '<strong>Devuelta</strong>'+
                '<div class="input-group">'+
                    '<span class="input-group-addon">$</span>'+  
                    '<input type="text" class="form-control nuevoDevueltaEfectivo" placeholder="0.00" readonly>'+                                  
                '</div>'+
            '</div>'
        );

        
        // formatear precios
        $(".nuevoEfectivoRecibido").number( true, 2 );
        $(".nuevoDevueltaEfectivo").number( true, 2 );

        // listar metodo de pago
        listarMetodoPago()

    } else if(metodo == "TC" || metodo == "TD") {

        $("#divMetodoPago").removeClass("col-xs-4");
        $("#divMetodoPago").addClass("col-xs-6");  

        $(this).parent().parent().parent().children(".inputMetodoDePago").html(

            '<!-- Número de transacción Tarjeta (TC o TD) -->'+
                        
            '<div class="col-xs-6" style="padding-left:0px;">'+
                '<strong>Transacción No.:</strong>'+
                '<div class="input-group">'+
                    '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required>'+
                    '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                    
                '</div>'+
            '</div>'
                    
        );

    } else {

        $("#divMetodoPago").removeClass("col-xs-4");
        $("#divMetodoPago").addClass("col-xs-6"); 

        $(this).parent().parent().parent().children(".inputMetodoDePago").html('');

    }
    

});


// Cambio efectivo

$(".formConsulta").on("change", "input.nuevoEfectivoRecibido", function(){   

    var efectivoRecibido = $(this).val();

    var cambio = Number(efectivoRecibido) - Number($("#nuevoTotalConsulta").attr("total"));   

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children(".capturarCambioEfectivo").children().children(".nuevoDevueltaEfectivo");
    
    $(nuevoCambioEfectivo).val(cambio);          

});



// Cambio transaccion

$(".formConsulta").on("change", "input#nuevoCodigoTransaccion", function(){   

    listarMetodoPago()    

});



// listar metodo de pago

function listarMetodoPago(){

    if( $("#nuevoMetodoPago").val() == "efectivo" ){

        $("#listaMetodoDePago").val("Efectivo");

    } else {

        $("#listaMetodoDePago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

    }

}


// Listar los medicamentos

function listarMedicamentos(){

    var listaMedicamentos = [];
 
    var cantidad = $(".nuevaCantidadMedicamento");
    var descripcion = $(".nuevaDescripcionMedicamento");
    var presentacion = $(".nuevaPresentacionMedicamento");
    var dosis = $(".nuevaDosisMedicamento");

    for(var i = 0; i < descripcion.length; i++){

        listaMedicamentos.push({
            "id" : $(descripcion[i]).attr("idMedicamento"),
            "cantidad" : $(cantidad[i]).val(),
            "descripcion" : $(descripcion[i]).val(),
            "presentacion" : $(presentacion[i]).val(),
            "dosis" : $(dosis).val()
        });

        console.log("listaMedicamentos", JSON.stringify(listaMedicamentos));

        $("#listaMedicamentos").val(JSON.stringify(listaMedicamentos));
    }
}


// Actualizar la cantiddd en la lista de medicamentos
$(".formConsulta").on("change", "input.nuevaCantidadMedicamento", function(){

    listarMedicamentos()

});



// Actualizar la dosis en la lista de medicamentos
$(".formConsulta").on("change", "input.nuevaDosisMedicamento", function(){

    listarMedicamentos()

});



// Date range as a button
$('#daterange-btn').daterangepicker(
    {
        ranges : {
            'Hoy'               : [moment(), moment()],
            'Ayer'              : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 días'    : [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 días'   : [moment().subtract(29, 'days'), moment()],
            'Este mes'          : [moment().startOf('month'), moment().endOf('month')],
            'Ultimo mes'        : [moment().subtract(1,'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate :   moment()
    },
    function (start, end){
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var fechaInicial = start.format('YYYY-M-D');

        var fechaFinal = end.format('YYYY-M-D');

        var capturarRango = $("#daterange-btn span").html();

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?route=consultas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
    }
)

// Cancelar rango de fechas
$(".daterangepicker .drp-buttons .cancelBtn").on("click", function(){

    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "consultas";

});


//capturar hoy
$(".daterangepicker .ranges li").on("click", function(event){

    var textoHoy = $(this).attr("data-range-key");

    if(textoHoy == "Hoy"){
        
        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth()+1;
        var año = d.getFullYear();

        var fechaInicial = año+"-"+mes+"-"+dia;
        var fechaFinal = año+"-"+mes+"-"+dia;

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?route=consultas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

    }

});