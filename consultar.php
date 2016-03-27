<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}else{
	require '/db/connect.php';
	$statement = $conexion->prepare('SELECT * FROM ordenes');
	$statement->execute();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Consulta de Ordenes</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/estilos.css">

</head>
<body>
	<div class="container">
		<br>
			<table class="table table-bordered display" id="tabla">
				<thead>
					<tr class="success">
						<th>Orden #</th>
						<th>Cedula</th>
						<th>Serial</th>
						<th>ID Tecnico</th>
						<th>Memoria</th>
						<th>Chip</th>
						<th>Tapa</th>
						<th>Falla</th>
						<th>Observacion</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $statement->fetch()):; ?>
						<tr>
							<td><?php echo $row[0]; ?></td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><?php echo $row[3]; ?></td>
							<td><?php echo $row[4]; ?></td>
							<td><?php echo $row[5]; ?></td>
							<td><?php echo $row[6]; ?></td>
							<td><?php echo $row[7]; ?></td>
							<td><?php echo $row[8]; ?></td>
							<td><?php echo $row[9]; ?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
				
			</table>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/tablas.js"></script>
	
</body>
</html>