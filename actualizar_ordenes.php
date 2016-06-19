<?php

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}


        
    $norden = $_POST['norden'];
    $tecnico = $_POST['id_tec'];
    $memoria = trim($_POST['memoria']);
    $chip = trim($_POST['chip']);
    $tapa = trim($_POST['tapa']);
    $falla = trim($_POST['falla']);
    $observacion = trim($_POST['observacion']);
    $status = $_POST['estado'];
    $fecha = date("Y-m-d",strtotime($_POST['fecha']));
    $total = $_POST['total'];
    $abono = $_POST['abono'];
    
    
    require dirname(__FILE__).'/db/connect.php';
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Actualizar las tablas 
    try{
        $statement = $conexion->prepare('
            UPDATE caracteristicas c,reparaciones r,pagos p,ordenes o 
            SET c.chip = :chip, c.memoria = :memoria, c.tapa = :tapa, c.falla = :falla, c.observacion = :observacion,
            r.status = :status, r.fecha = :fecha,
            p.total = :total, p.abono = :abono, 
            o.id_tec = :tecnico
            WHERE c.id_caract = :norden AND r.numero = :norden AND p.id_pago = :norden AND o.numero = :norden;
        ');
        $statement->execute(array(
            ':chip' => $chip,
            ':memoria' => $memoria,
            ':tapa' => $tapa,
            ':falla' => $falla,
            ':observacion' => $observacion,
            ':status' => $status,
            ':fecha' => $fecha,
            ':total' => $total,
            ':abono' => $abono,
            ':tecnico' => $tecnico,
            ':norden' => $norden
        ));
    }catch(PDOException $e){
        echo 'Error al actualizar los datos: ' . $e->getMessage();
    }
    


?>
