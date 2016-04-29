/**
 * Created by gorydev on 28/04/2016.
 * Funcion para actualizar los datos de un cliente / orden usando Ajax
 */

$('#btn_actualizar').click(function(){
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var cedula = $('#cedula').val();
    var ajaxUrl = 'actualizar.php';
    data = {'name': nombre, 'phone': telefono, 'id': cedula};
    $.post(ajaxUrl, data, function (response) {
        console.log("Esta es la respuesta " + response.toString());
        console.log("Esta es la data " + data);
        if(response.empty())
            alert("Datos NO Actualizados!");
        else{
            alert("Datos Actualizados!");
            location.reload();
        }

    })
});

$('#actualizar').click(function(){
    var norden = $('#norden').val();
    norden = parseInt(norden);
    var idTect = $('#id_tec').val();
    idTect = parseInt(idTect);
    var memoria = $('#memoria').val();
    var chip = $('#chip').val();
    var tapa = $('#tapa').val();
    var falla = $('#falla').val();
    var observacion = $('#observacion').val();
    var status = $('#status').val();
    var ajaxUrl = 'actualizar_ordenes.php';
    console.log("orden es un " + typeof(norden));
    console.log("tecnico es un " + typeof(idTect));
    data = {'orden': norden, 'tec': idTect, 'mem': memoria, 'sim': chip, 'back': tapa,
            'fail': falla, 'observ': observacion, 'stat': status};
    $.post(ajaxUrl, data, function (response) {
        console.log("respuesta " + response);
        console.log("data " + data);
        alert("Datos actualizados!");
        location.reload();
    })
});
