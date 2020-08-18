/* EDITAR USUARIO */

$(".btnEditarUsuario").click(function(){

    let idUsuario = $(this).attr("idUsuario");
    //console.log("idUsuario", idUsuario);

    let datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            // console.log("respuesta", respuesta);

            $("#editar-nombre").val(respuesta["nombre"]);
            $("#editar-apellido").val(respuesta["apellido"]);
            $("#editar-usuario").val(respuesta["usuario"]);
            $("#editar-rol").html(respuesta["rol"]);

            // Si no se modifica la password
            $("#pass-actual").val(respuesta["pass"]);
            
            // Si no se modifica el perfil :
            $("#editar-rol").val(respuesta["rol"]);           

        }
    });

});


/* ELIMINAR USUARIO */

$(document).on("click", ".btnEliminarUsuario", function(){

	var idUsuarioEliminar = $(this).attr("idUsuarioEliminar");	
	var usuarioEliminar = $(this).attr("usuarioEliminar");

	swal({

		title: '¿Está seguro que desea eliminar este usuario?',
		text: "Si continúa, este usuario ya no podrá acceder al sistema y se eliminaran todos sus datos. Haga click en Confirmar para eliminar, de lo contrario haga click en cancelar",
		type: 'warning',
		showCancelButton: true,
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Confirmar',

	}).then((result)=>{

		if(result.value){

			window.location = "index.php?route=usuarios&idUsuarioEliminar="+idUsuarioEliminar+"&usuarioEliminar="+usuarioEliminar;
		}
	});

});