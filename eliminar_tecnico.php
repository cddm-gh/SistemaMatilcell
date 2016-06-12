<?php
require_once dirname(__FILE__).'/db/connect.php';

    $id = $_POST['id'];
    $statement = $conexion->prepare('DELETE FROM tecnicos WHERE id_tec = :id');
    $statement->execute(array(
        ':id' => $id
    ));
?>