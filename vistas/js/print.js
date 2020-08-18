// Imprimir receta

$(".my-datatable").on("click", ".btnImprimirReceta", function(){

    var codigoReceta = $(this).attr("codigoReceta");

    window.open("vistas/extensiones/tcpdf/pdf/receta.php?codigoReceta="+codigoReceta, "_blank");

});