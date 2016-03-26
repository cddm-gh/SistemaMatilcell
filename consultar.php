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
	<title>Consulta de Ordenes</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<table>
		<tr>
			<th>N Orden</th>
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
	</table>
</body>
</html>