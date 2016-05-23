<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}else{
	require dirname(__FILE__).'/db/connect.php';
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
	<div class="container-fluid">
		<br>
			<div class="row">
				<table class="table table-bordered table-condensed" id="tabla_ordenes" onclick="clickEnTabla('tabla_ordenes');">
					<thead>
						<tr class="info">
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
							<th>Fecha</th>
							<th>Total</th>
							<th>Abono</th>
							<th>Restante</th>
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
								<td><?php echo $row[10]; ?></td>
								<td><?php echo $row[11]; ?></td>
								<td><?php echo $row[12]; ?></td>
								<td><?php echo $row[13]; ?></td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-md-12">
				<!-- Agregar formulario para al dar click en una fila de la tabla mostrar los datos y poder editar -->
					<form action="" mathod="POST" id="orden">
						<div class="col-md-2">
							<div class="form-group">
								<label for="norden">Orden #</label>
								<input type="text" name="norden" id="norden" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="cedula">Cedula</label>
								<input type="text" name="cedula" id="cedula" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="serial">Serial</label>
								<input type="text" name="serial" id="serial" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label for="id_tec">ID Tec</label>
								<input type="text" name="id_tec" id="id_tec" class="form-control">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label for="memoria">Memoria</label>
								<input type="text" name="memoria" id="memoria" class="form-control">
							</div>	
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label for="chip">Chip:</label>
								<input type="text" name="chip" id="chip" class="form-control">
							</div>	
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label for="tapa">Tapa:</label>
								<input type="text" name="tapa" id="tapa" class="form-control">
							</div>	
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="falla">Falla:</label>
									<textarea name="falla" id="falla" class="form-control"></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="observacion">Observacion:</label>
									<textarea name="observacion" id="observacion" class="form-control"></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<label for="estado">Estado del Equipo:</label>
								<select name="estado" class="form-control" id="estado" name="estado">
									<option value="nada" selected="true" disabled="true">-- Estado</option>
									<option value="recibido" name="recibido">Recibido</option>
									<option value="reparado" name="reparado">Reparado</option>
									<option value="entregado" name="entregado">Entregado</option>
								</select><br>	
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-3">
								<div class="form-group">
									<label for="fecha">Fecha:</label>
									<input type="text" name="fecha" id="fecha" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="total">Total:</label>
									<input type="text" name="total" id="total" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="abono">Abono:</label>
									<input type="text" name="abono" id="abono" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="resta">Restante:</label>
									<input type="text" name="resta" id="resta" class="form-control">
								</div>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-md-offset-5">
								<button class="btn btn-info" id="actualizar">Actualizar Datos</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<br>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/tablas.js"></script>
	<script type="text/javascript" src="js/actualizar_datos.js"></script>
</body>
</html>