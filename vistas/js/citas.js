/* Confirmar si existe una cita el mismo dia a la misma hora */
$("#agendar-fecha-cita").change(function(){

	var fechaCita = $(this).val();	

	var fdata = new FormData();
	fdata.append("fechaCita", fechaCita);

	$.ajax({

		url: "ajax/citas.ajax.php",
		method: "POST",
		data: fdata,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(result){

			//console.log("result", result);
			
			if(result){				
                $("#fechasCitas").val(result['dia']);                
            }

		}
	});

});


$("#hora-termino").on("blur",function(){

	$("#comparar").hide();    
	var horaInicio = $("#hora-inicio").val();	
	var horaTermino = $(this).val();
	var fecha = $("#hora-inicio").val();	

	var fdata = new FormData();
	fdata.append("horaInicio", horaInicio);
	fdata.append("horaTermino", horaTermino);
	fdata.append("fecha", fecha);

	$.ajax({

		url: "ajax/citas.ajax.php",
		method: "POST",
		data: fdata,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(result){

			//console.log("result", result);
			
			if(result){				
				$("#comparar").show();    
				$("#hora-inicio").val('');	
				$("#hora-termino").val('');					            
            }

		}
	});

});