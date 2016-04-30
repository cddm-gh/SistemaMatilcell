//funcion para enmascarar los inputs
$(document).ready(function($){
	
	/*Prueba para saber de que pais se ingresa a la pagina web
	var requestUrl = "http://ip-api.com/json";

	$.ajax({
	  url: requestUrl,
	  type: 'GET',
	  success: function(json)
	  {
	    console.log("My country is: " + json.country);
	    console.log("My IP address is: " + json.query);
	    if(json.country === 'Venezuela')
	    	alert("Go buy food!");
	    else
	    	alert("You don't have to buy food");
	  },
	  error: function(err)
	  {
	    console.log("Request failed, error= " + err);
	  }
	});*/

	$('#cedula').mask("99999999");
	$('#telefono').mask("9999-9999999");
	$('#serial').mask("999999999999999");
});

//Funcion para al salir del input cedula busca en la BD por esa cedula
//Si la encuentra regresa los datos de ese cliente y los agrega en los campos correspondientes

$('#cedula').focusout(function(){
	var cedula = $('#cedula').val();
	if($.trim(cedula) !== ''){
		$.post('buscar.php', {cedula: cedula}, function(data){
			if(data !== ''){
				//console.log("I found this " + data);
				var mitad = data.split('/');
				$('#nombre').val(mitad[0]);
				$('#telefono').val(mitad[1]);	
				$('#serial').focus();	
				$('#cliente_enc').prop("checked", true);
				
			}else{
				console.log("I didn't got any data =( for this ID " + cedula);
				$('#cliente_enc').prop("checked", false);
			}
		});
	}
	if($('#cedula').val().length >= 5)
		$('#barra').css('width','15%');
});
//Lo mismo de la funcion anterior pero buscando el serial del equipo
$('#serial').focusout(function(){
	var serial = $('#serial').val();
	if($.trim(serial) != ''){
		$.post('buscar.php', {serial: serial}, function(data){
			if(data !== ''){
				//alert(data);
				var mitad = data.split('/');
				$('#marca').val(mitad[0]);
				$('#modelo').val(mitad[1]);	
				$('#modelo').focus();	
				$('#equipo_enc').prop("checked", true);
			}else{
				console.log("No recibi ningun data =(")
				$('#cliente_enc').prop("checked", false);
			}
		});
	}
	if($('#serial').val().length == 15)
		$('#barra').css('width','60%');
});

$('#nombre').focusout(function(){
	if($(this).val().length >= 5)
		$('#barra').css('width','30%');
});
$('#telefono').focusout(function(){
	if($(this).val().length >= 5)
		$('#barra').css('width','45%');
});
$('#marca').focusout(function(){
	if($(this).val().length >= 3)
		$('#barra').css('width','75%');
});
$('#modelo').focusout(function(){
	if($(this).val().length >= 3)
		$('#barra').css('width','90%');
});
$('#falla').focusout(function(){
	if($(this).val().length >= 5)
		$('#barra').css('width','95%');
});
$('#observacion').focusout(function(){
	$('#barra').css('width','100%');
});

//Funciones para restar y actualizar el Total de la orden
$('#total').focusout(function(){
    if(!$(this).val()){
        $(this).focus();
    }
});
$('#abono').focusout(function () {
    if(!$(this).val()){
        $(this).focus();
    }else{
        var total = parseFloat($('#total').val());
        var abono =  parseFloat($('#abono').val());
        var resta = total - abono;
        $('#resta').val(resta);
    }
});