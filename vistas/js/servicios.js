/* EDITAR SERVICIO */

$(".btnEditarServicio").click(function(){

    let idServicio = $(this).attr("idServicio");
    //console.log("idUsuario", idUsuario);

    let datos = new FormData();
    datos.append("idServicio", idServicio);

    $.ajax({
        url: "ajax/servicios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            // console.log("respuesta", respuesta);

            $("#editar-nombreServicio").val(respuesta["nombre"]);
            $("#editar-costoServicio").val(respuesta["costo"]);   
            $("#idServicioEditar").val(idServicio);                               

        }
    });

});


/* ELIMINAR SERVICIO */

$(document).on("click", ".btnEliminarServicio", function(){

	var idServicioEliminar = $(this).attr("idServicioEliminar");		

	swal({

		title: '¿Está seguro que desea eliminar este Servicio?',
		text: "Si continúa, este usuario ya no podrá acceder al sistema y se eliminaran todos sus datos. Haga click en Confirmar para eliminar, de lo contrario haga click en cancelar",
		type: 'warning',
		showCancelButton: true,
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Confirmar',

	}).then((result)=>{

		if(result.value){

			window.location = "index.php?route=usuarios&idServicioEliminar="+idServicioEliminar;
		}
	});

});