//Funcion para al salir del input cedula busca en la BD por esa cedula
//Si la encuentra regresa los datos de ese cliente y los agrega en los campos correspondientes
$('input#cedula').focusout(function(){
	var cedula = $('input#cedula').val();
	if($.trim(cedula) != ''){
		$.post('ajax/buscar.php', {cedula: cedula}, function(data){
			if(data !== ''){
				var mitad = data.split('/');
				$('#nombre').val(mitad[0]);
				$('#telefono').val(mitad[1]);	
				$('#serial').focus();	
			}
		});
	}
});
//Lo mismo de la funcion anterior pero buscando el serial del equipo
$('input#serial').focusout(function(){
	var serial = $('input#serial').val();
	if($.trim(serial) != ''){
		$.post('ajax/buscar.php', {serial: serial}, function(data){
			if(data !== ''){
				var mitad = data.split('/');
				$('#marca').val(mitad[0]);
				$('#modelo').val(mitad[1]);	
				$('#modelo').focus();	
			}
		});
	}
});