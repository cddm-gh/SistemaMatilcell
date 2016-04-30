<?php  
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}else{
	require dirname(__FILE__).'/db/connect.php';
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
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	
</head>
<body>
	
	<div class="container">
		<br>
		<table class="table table-bordered display" id="tabla_clientes" onclick="clickEnTabla('tabla_clientes');">
			<thead>
				<tr class="success">
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Telefono</th>
				</tr>
			</thead>
			<tbody>
				<?php while($row = $statement->fetch()):; ?>
				<tr>
					<td><?php echo $row[0]; ?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>	
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-12">
				<form action="" id="orden">
					<div class="col-md-4">
						<div class="form-group">
							<label for="cedula">Cedula</label>
							<input type="text" name="cedula" id="cedula" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="telefono">Telefono</label>
							<input type="text" name="telefono" id="telefono" class="form-control">
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-md-offset-5">
				<button class="btn btn-info" id="btn_actualizar">Actualizar Datos</button>
			</div>
		</div>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/tablas.js"></script>
	<script type="text/javascript" src="js/actualizar_datos.js"></script>
</body>
</html>