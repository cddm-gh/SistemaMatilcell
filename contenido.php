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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sistema de Ordenes Mundo Matilcell</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	
	<div class="contenedor">
		<h1 class="titulo">Contenido del sitio</h1>
		<h2>Bienvenido <?php echo $nombre['nombre']; ?></h2>
		<a href="cerrar.php">Cerrar Sesion</a>
		<hr>
		<div class="contenido">
			<a href="orden.php" target="blank">Crear Nueva Orden</a><br>
			<a href="consultar.php" target="blank">Consultar Ordenes</a><br>
			<a href="clientes.php" target="blank">Consultar Clientes</a><br>
		</div>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>