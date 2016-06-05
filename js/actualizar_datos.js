/**
 * Created by gorydev on 28/04/2016.
 * Funcion para actualizar los datos de un cliente / orden usando Ajax
 */

$('#btn_actualizar').click(function(){
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var cedula = $('#cedula').val();
    var ajaxUrl = 'actualizar_clientes.php';
    
    data = {'name': nombre, 'phone': telefono, 'id': cedula};
    $.post(ajaxUrl, data, function (response) {
        if(response.empty)
            alert("Datos NO Actualizados!");
        else{
            alert("Datos Actualizados!");
            location.reload();
        }

    })
});

/*$('#actualizar').click(function(){
    var norden = $('#norden').val();
    norden = parseInt(norden);
    var idTect = $('#id_tec').val();
    idTect = parseInt(idTect);
    var memoria = $('#memoria').val();
    var chip = $('#chip').val();
    var tapa = $('#tapa').val();
    var falla = $('#falla').val();
    var observacion = $('#observacion').val();
    var status = $('#estado').val();
    var fecha = $('#fecha').val();
    var total = $('#total').val();
    total = parseInt(total);
    var abono = $('#abono').val();
    abono = parseInt(abono);
    var ajaxUrl = 'actualizar_ordenes.php';
    
    
    data = {'orden': norden, 'tec': idTect, 'mem': memoria, 'sim': chip, 'back': tapa,
            'fall': falla, 'observ': observacion, 'stat': status, 'fecha':fecha, 'total':total, 'abono':abono};
    
    console.log(data);
    $.post(ajaxUrl, data, function (response) {
        console.log(data);
        if(response.empty){
            alert("Datos NO actualizados!"); 
            console.log(data);  
        }
        else{
            alert("Datos Actualizados!!");
            location.reload();
            console.log(data);
        }
    })
});*/
