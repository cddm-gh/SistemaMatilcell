<?php  
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}else{
	require '/db/connect.php';
	$statement = $conexion->prepare('SELECT * FROM clientes');
	$statement->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clientes</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	
	<div class="container">
		<br>
		<table class="table table-hover table-bordered">
			<tr class="success">
				<th>Cedula</th>
				<th>Nombre</th>
				<th>Telefono</th>
			</tr>
			<?php while($row = $statement->fetch()):; ?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[2]; ?></td>	
			</tr>
			<?php endwhile; ?>
		</table>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>