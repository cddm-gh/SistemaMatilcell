<?php
session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <h1>Reportes del Sistema</h1>
    <div class="contenido">
		<div class="col-md-4">
			<ul class="nav nav-pills nav-stacked text-center">
				<li role="presentation" class="list-group-item list-group-item-info"><a href="reporte_tecnicos.php">TÉCNICO CON MÁS REPARACIONES
					<span class="glyphicon glyphicon-file"></span></a></li>
				<li role="presentation" class="list-group-item list-group-item-success"><a href="consultar_ordenes.php">MEJOR CLIENTE
					<span class="glyphicon glyphicon-search"></span></a></li>
			</ul>
		</div>
	</div>	

    <script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>