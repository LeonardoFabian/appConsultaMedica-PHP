/* Completar los campos con los datos del paciente */

$("#nuevo-cedula").change(function(){

	$(".alert").remove();

	var cedula = $(this).val();

	var fdata = new FormData();
	fdata.append("validarCedula", cedula);

	$.ajax({

		url: "ajax/pacientes.ajax.php",
		method: "POST",
		data: fdata,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(result){

			//console.log("result", result);
			
			if(result){

				$("#nuevo-paciente-nombre").val(result['Nombres']);
                $("#nuevo-paciente-apellido").val(result['Apellido1']+" "+result['Apellido2']);
                $("#nuevo-paciente-nacimiento").val(result['FechaNacimiento']);
                
			} 

		}
	});

});

/* Confirmar si existe un pacienteen la base de datos al crear */
$("#nuevo-cedula").on("blur",function(){

	$(".alert").remove();

	var cedula = $(this).val();

	var fdata = new FormData();
	fdata.append("consultarCedula", cedula);

	$.ajax({

		url: "ajax/pacientes.ajax.php",
		method: "POST",
		data: fdata,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(result){

			console.log("result", result);
			
			if(result){				
                $("#nuevo-cedula").parent().after('<div class="alert alert-warning">Este paciente ya existe en la base de datos</div>');
                $("#nuevo-cedula").val('');
                $("#nuevo-paciente-nombre").val('');
                $("#nuevo-paciente-apellido").val('');
                $("#nuevo-paciente-nacimiento").val('');
            }

		}
	});

});

/* Editar paciente */

$(".btnEditarPaciente").click(function(){

    let idPaciente = $(this).attr("idPaciente");
    //console.log("idUsuario", idUsuario);

    let datos = new FormData();
    datos.append("idPaciente", idPaciente);

    $.ajax({
        url: "ajax/pacientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            // console.log("respuesta", respuesta);
            $("#editar-cedula").val(respuesta["cedula"]);
            $("#editar-paciente-nombre").val(respuesta["nombre"]);
            $("#editar-paciente-apellido").val(respuesta["apellido"]);
            $("#editar-paciente-nacimiento").val(respuesta["fechaNacimiento"]);
            $("#editar-paciente-gruposanguineo").html(respuesta["tipoSanguineo"]);
            $("#editar-paciente-telefono").val(respuesta["telefono"]);

            // Si no se modifica la password
            $("#pass-actual").val(respuesta["pass"]);
            
            // Si no se modifica el perfil :
            $("#editar-rol").val(respuesta["rol"]);           

        }
    });

});

/* ELIMINAR PACIENTE */

$(document).on("click", ".btnEliminarPaciente", function(){

	var idPacienteEliminar = $(this).attr("idPacienteEliminar");	
	var pacienteCedula = $(this).attr("pacienteCedula");

	swal({

		title: '¿Está seguro que desea eliminar este paciente?',
		text: "Si continúa, este usuario ya no podrá acceder al sistema y se eliminaran todos sus datos. Haga click en Confirmar para eliminar, de lo contrario haga click en cancelar",
		type: 'warning',
		showCancelButton: true,
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Confirmar',

	}).then((result)=>{

		if(result.value){

			window.location = "index.php?route=pacientes&idPacienteEliminar="+idPacienteEliminar+"&pacienteCedula="+pacienteCedula;
		}
	});

});