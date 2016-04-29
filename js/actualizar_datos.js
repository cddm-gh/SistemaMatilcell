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
        alert("Datos Actualizados!");
        location.reload();
    })
});
