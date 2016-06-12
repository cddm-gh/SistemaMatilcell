<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}else{
	$usuario = $_SESSION['usuario'];
	require_once dirname(__FILE__).'/db/connect.php';
	$statement = $conexion->prepare("SELECT nombre FROM empleados WHERE usuario = :usuario");
	$statement->execute(array(
		':usuario' => $usuario
	));
	$nombre = $statement->fetch();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sistema de Ordenes Mundo Matilcell</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	
</head>
<body>
	
	<div class="contenedor">
		<h1 class="titulo">Panel de control del sistema</h1>
		<h2>Bienvenido <- <?php echo $nombre['nombre']; ?> -> </h2>
		<a href="cerrar.php"><span class="label label-danger">Cerrar Sesión <span class="glyphicon glyphicon-off"></span></span></a>
		<hr>
		<div class="contenido">
			<div class="col-md-4">
				<ul class="nav nav-pills nav-stacked text-center">
					<li role="presentation" class="list-group-item list-group-item-info"><a href="orden.php">CREAR ORDEN
						<span class="glyphicon glyphicon-file"></span></a></li>
					<li role="presentation" class="list-group-item list-group-item-success"><a href="consultar_ordenes.php">CONSULTAR ORDENES
						<span class="glyphicon glyphicon-search"></span></a></li>
					<li role="presentation" class="list-group-item list-group-item-success"><a href="consultar_clientes.php">CONSULTAR CLIENTES
						<span class="glyphicon glyphicon-search"></span></a></li>
					<li role="presentation" class="list-group-item list-group-item-warning"><a href="administracion.php">AREA ADMINISTRATIVA DEL SISTEMA
						<span class="glyphicon glyphicon-cog"></span></a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>