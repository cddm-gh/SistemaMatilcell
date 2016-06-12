<?php
    require_once dirname(__FILE__).'/db/connect.php';

    $id = $_POST['id'];
    $statement = $conexion->prepare('DELETE FROM empleados WHERE id_emp = :id');
    $statement->execute(array(
        ':id' => $id
    ));
    
?>