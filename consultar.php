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
			<div class="row">
				<table class="table table-bordered display" id="tabla_ordenes" onclick="clickEnTabla('tabla_ordenes');">
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
			<div class="row">
				<div class="col-md-6 col-md-offset-2">
				<!-- Agregar formulario para al dar click en una fila de la tabla mostrar los datos y poder editar -->
					<form action="" id="orden">
						<div class="form-group">
							<label for="norden">Orden #</label>
							<input type="text" name="norden" id="norden" class="form-control">
						</div>
						<div class="form-group">
							<label for="cedula">Cedula</label>
							<input type="text" name="cedula" id="cedula" class="form-control">
						</div>
						<div class="form-group">
							<label for="serial">Serial</label>
							<input type="text" name="serial" id="serial" class="form-control">
						</div>
						<div class="form-group">
							<label for="id_tec">ID Tecnico</label>
							<input type="text" name="id_tec" id="id_tec" class="form-control">
						</div>
						<div class="form-group">
							<label for="memoria">Memoria</label>
							<input type="text" name="memoria" id="memoria" class="form-control">
						</div>
						<div class="form-group">
							<label for="chip">Chip:</label>
							<input type="text" name="chip" id="chip" class="form-control">
						</div>
						<div class="form-group">
							<label for="tapa">Tapa:</label>
							<input type="text" name="tapa" id="tapa" class="form-control">
						</div>
						<div class="form-group">
							<label for="falla">Falla:</label>
							<textarea name="falla" id="falla" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="observacion">Observacion:</label>
							<textarea name="observacion" id="observacion" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="status">Status:</label>
							<input type="text" name="status" id="status" class="form-control">
						</div>
					</form>
				</div>
			</div>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/tablas.js"></script>
	
</body>
</html>