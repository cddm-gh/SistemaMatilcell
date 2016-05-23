$(document).ready(function(){

	//Tabla Ordenes
	$('#tabla_ordenes').dataTable({
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
        },
        "autoWidth": true,
        "iDisplayLength": 25
	});
	//Tabla Clientes
	$('#tabla_clientes').dataTable({
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
        },
        "autoWidth": true,
        "iDisplayLength": 25
	});
	//Tabla Equipos

});

//La funcion recibe el ID de la tabla que esta haciendo la llamada
function clickEnTabla(id_elemento){
	//leyendo los IDs de los elementos
	var tabla = document.getElementById(id_elemento);
	var thead = tabla.getElementsByTagName("thead")[0];
	var tbody = tabla.getElementsByTagName("tbody")[0];
	var ishigh;

	//Al hacer click en el cuerpo de la tabla verificar si esta highlighted o esta en blanco (sin seleccionar)
	tbody.onclick = function(e){
		e = e || window.event;
		var td = e.target || e.srcElement;
		var row = td.parentNode;

		if(ishigh && ishigh != row){
			ishigh.className = '';
		}	
		row.className = row.className === "highlighted" ? "" : "highlighted";
		ishigh = row;
		//enviar la fila que se ha clickeado
        console.log('Hola consola');
		llenarCampos(row, id_elemento);
	}
	//Una vez clickeada una fila se puede mover con las flechas para ir seleccionando
	document.onkeydown = function (e) {
        e = e || event;
        var code = e.keyCode,
            rowslim = tabla.rows.length - 2,
            newhigh;
        if (code === 38) { //up arraow
            newhigh = rowindex(ishigh) - 2;
            if (!ishigh || newhigh < 0) {
                return GoTo(id_elemento, rowslim);
            }
            return GoTo(id_elemento, newhigh);//OJO AQUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
        } else if (code === 40) { //down arrow
            newhigh = rowindex(ishigh);
            if (!ishigh || newhigh > rowslim) {
                return GoTo(id_elemento, 0);
            }
            return GoTo(id_elemento, newhigh);
        }
    }

    function GoTo(id, nu) {
        var obj = document.getElementById(id),
            trs = obj.getElementsByTagName('TR');
        nu = nu + 1;
        if (trs[nu]) {
            if (ishigh && ishigh != trs[nu]) {
                ishigh.className = '';
            }
            trs[nu].className = trs[nu].className == "highlighted" ? "" : "highlighted";
            ishigh = trs[nu];
        }
        
        llenarCampos(trs[nu],id);
    }

    function rowindex(row) {
        var rows = id_elemento.rows,
            i = rows.length;
        while (--i > -1) {
            if (rows[i] === row) {
                return i;
            }
        }
    }
    //funcion que retorna el id de un elemento
    function el(id) {
        return document.getElementById(id);
    }
    //asignar los dato del arreglo row a cada uno de los elementos del formulario por su ID
    function llenarCampos(row, id_elemento) {
    	if(id_elemento === "tabla_ordenes"){
	        el('norden').value = row.cells[0].innerHTML;
	        el('cedula').value = row.cells[1].innerHTML;
	        el('serial').value = row.cells[2].innerHTML;
	        el('id_tec').value = row.cells[3].innerHTML;
	        el('memoria').value = row.cells[4].innerHTML;
	        el('chip').value = row.cells[5].innerHTML;
	        el('tapa').value = row.cells[6].innerHTML;
	        el('falla').value = row.cells[7].innerHTML;
	        el('observacion').value = row.cells[8].innerHTML;
            el('estado').value = row.cells[9].innerHTML;
            el('fecha').value = row.cells[10].innerHTML;
            el('total').value = row.cells[11].innerHTML;
            el('abono').value = row.cells[12].innerHTML;
            el('resta').value = row.cells[13].innerHTML;
            
            console.log("celda " + row.cells[9].innerHTML);
            
	        if(row.cells[9].innerHTML === "recibido"){
                $('#estado option:contains("Recibido")').attr("selected",true);
            }
            if(row.cells[9].innerHTML === "reparado"){
                $('#estado option:contains("Reparado")').attr("selected",true);
            }
            if(row.cells[9].innerHTML === "entregado"){
                $('#estado option:contains("Entregado")').attr("selected",true);
            }
            if(row.cells[9].innerHTML === ""){
                $('#estado option:contains("-- Estado")').attr("selected",true);
            }

    	}else if(id_elemento === "tabla_clientes"){
    		el('cedula').value = row.cells[0].innerHTML;
	        el('nombre').value = row.cells[1].innerHTML;
	        el('telefono').value = row.cells[2].innerHTML;
            console.log("hola consola clientes");
    	} else{
    		console.log("No existe ese elemento.");
    	}
    }
}