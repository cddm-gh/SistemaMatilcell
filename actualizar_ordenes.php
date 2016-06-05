<?php
/**
 * Created by PhpStorm.
 * User: gorydev
 * Date: 28/04/2016
 * Time: 09:44 PM
 */
 
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if(isset($_POST['actualizar'])){
        
    $norden = trim($_POST['norden']);
    $tecnico = trim($_POST['id_tec']);
    $memoria = trim($_POST['memoria']);
    $chip = trim($_POST['chip']);
    $tapa = trim($_POST['tapa']);
    $falla = trim($_POST['falla']);
    $observacion = trim($_POST['observacion']);
    $status = $_POST['estado'];
    $fecha = trim($_POST['fecha']);
    $total = trim($_POST['total']);
    $abono = trim($_POST['abono']);
    
    
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
    
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Actualizar datos de Orden</title>
</head>
<body>
	
	<p><h1>Orden actualizada con éxito!</h1></p>
	<script>
        window.setTimeout(function() {
            window.location = 'consultar_ordenes.php';
        }, 1000);
	</script>
</body>
</html>