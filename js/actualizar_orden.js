//Al clickear boton actualizar ordenes
$('#actualizar').click(function(){
    var orden = parseInt($('#norden').val());
    var id_tecnico = parseInt($('#id_tec').val());
    var memoria = $('#memoria').val();
    var chip = $('#chip').val();
    var tapa = $('#tapa').val();
    var falla = $('#falla').val();
    var observacion = $('#observacion').val();
    var estado = $('#estado').val();
    var fecha = $('#fecha').val();
    var total = parseInt($('#total').val());
    var abono = parseInt($('#abono').val());
    var ajaxUrl = 'actualizar_ordenes.php';
    
    data = { 'norden': orden, 'id_tec': id_tecnico, 'memoria': memoria, 'chip': chip, 'tapa': tapa, 
            'falla': falla, 'observacion': observacion, 'estado': estado, 'fecha': fecha, 
            'total': total, 'abono': abono };
        
    
    //console.log(data);
    $.post(ajaxUrl, data, function(response){
        if(response.empty)
            alert("Datos no actualizados");
        else{
            alert("Datos Actualizados.");
            location.reload();
        }
    }) 
    
});