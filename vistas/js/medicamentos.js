/* EDITAR SERVICIO */

$(".btnEditarMedicamento").click(function(){

    let idMedicamento = $(this).attr("idMedicamento");
    //console.log("idUsuario", idUsuario);

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

            // console.log("respuesta", respuesta);

            $("#editar-codigoMedicamento").val(respuesta["codigo"]);
            $("#editar-nombreComercial").val(respuesta["nombreComercial"]);   
            $("#editar-principioActivo").val(respuesta["principioActivo"]);  
            $("#editar-presentacion").val(respuesta["presentacion"]);  

            $("#idServicioEditar").val(idServicio);                               

        }
    });

});


/* ELIMINAR SERVICIO */

$(document).on("click", ".btnEliminarMedicamento", function(){

	var idMedicamentoEliminar = $(this).attr("idMedicamentoEliminar");		

	swal({

		title: '¿Está seguro que desea eliminar este Medicamento?',
		text: "Si continúa, este usuario ya no podrá acceder al sistema y se eliminaran todos sus datos. Haga click en Confirmar para eliminar, de lo contrario haga click en cancelar",
		type: 'warning',
		showCancelButton: true,
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Confirmar',

	}).then((result)=>{

		if(result.value){

			window.location = "index.php?route=medicamentos&idMedicamentoEliminar="+idMedicamentoEliminar;
		}
	});

});