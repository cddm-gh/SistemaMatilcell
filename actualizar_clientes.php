<?php
/**
 * Created by PhpStorm.
 * User: gorydev
 * Date: 28/04/2016
 * Time: 08:38 PM
 * Actualizar los datos de un cliente
 */
if(isset($_POST['name']) and isset($_POST['phone'])){
    $nombre = $_POST['name'];
    $telefono = $_POST['phone'];
    $cedula = $_POST['id'];
    
    require dirname(__FILE__).'/db/connect.php';
    $statement = $conexion->prepare('UPDATE clientes SET nombre = :nombre, telefono = :telefono WHERE cedula = :cedula');
    $statement->execute(array(
        ':nombre' => $nombre,
        ':telefono' => $telefono,
        ':cedula' => $cedula
    ));
}

?>