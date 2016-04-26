<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
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