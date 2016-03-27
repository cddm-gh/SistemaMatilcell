$(document).ready(function(){
	$('#tabla').dataTable({
		"language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "Nada encontrado - sorry",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ total registros)",
            "search": "Buscar:",
            "paginate":{
            	"first": "Primero",
            	"last": "Ultimo",
            	"next": "Siguiente",
            	"previous": "Anterior"
            }
        }
	});//tabla de ordenes
	$('#tabla2').dataTable({
		"language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "Nada encontrado - sorry",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ total registros)",
            "search": "Buscar:",
            "paginate":{
            	"first": "Primero",
            	"last": "Ultimo",
            	"next": "Siguiente",
            	"previous": "Anterior"
            }
        }
	});//tabla de clientes
});