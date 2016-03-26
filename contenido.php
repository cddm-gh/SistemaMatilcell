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
	<title>Sistema de Ordenes Mundo Matilcell</title>
</head>
<body>
	<div class="contenedor">
		<h1 class="titulo">Contenido del sitio</h1>
		<a href="cerrar.php">Cerrar Sesion</a>
		<hr class="border">
		<div class="contenido">
			<a href="orden.php" target="blank">Crear Nueva Orden</a><br>
			<a href="#">Consultar Ordenes</a><br>
			<a href="#">Ver Clientes</a><br>
		</div>
	</div>
</body>
</html>