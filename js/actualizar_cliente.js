/**
 * Created by gorydev on 28/04/2016.
 * Funcion para actualizar los datos de un cliente / orden usando Ajax
 */
//Al clickear boton actualizar clientes
$('#btn_actualizar').click(function(){
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var cedula = $('#cedula').val();
    var ajaxUrl = 'actualizar_clientes.php';
    
    data = {'name': nombre, 'phone': telefono, 'id': cedula};
    //console.log(data);
    $.post(ajaxUrl, data, function (response) {
        if(response.empty)
            alert("Datos NO Actualizados!");
        else{
            alert("Datos Actualizados!");
            location.reload();
        }

    })
});


