function eliminarEmpleado(){
    var id = parseInt($('#nomemp').val());
    var ajaxUrl = "eliminar_empleado.php";

    data = {'id': id};
    $.post(ajaxUrl, data, function (response) {
        if(response.empty)
            alert("Empleado no Eliminado!");
        else{
            alert("Empleado Eliminado!");
            location.reload();
        }

    })

}
function eliminarTecnico(){
    var id = parseInt($('#nomtec').val());
    var ajaxUrl = "eliminar_tecnico.php";

    data = {'id': id};
    $.post(ajaxUrl, data, function (response) {
        if(response.empty)
            alert("Técnico no Eliminado!");
        else{
            alert("Técnico Eliminado!");
            location.reload();
        }

    })
}