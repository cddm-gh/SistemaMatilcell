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
	<title>Creacion de Ordenes</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div class="container">
		<br>
		<div class="row">			
			<div class="col-md-4">
				<form action="validar_orden.php" method="POST" name="orden">
					<div class="form-group">
						<label for="cedula">Cedula:</label>
						<input type="text" class="form-control" id="cedula" name="cedula" placeholder="Numero De Cedula" required="true" 
							autofocus="true" maxlength="9">
					</div>
					
					<div class="form-group">
						<label for="nombre">Nombre:</label>
						<input type="text" class="form-control textoMayuscula" id="nombre" name="nombre" placeholder="Nombre del cliente" 
							required="true" maxlength="45">
					</div>
					
					<div class="form-group">
						<label for="telefono">Telefono:</label>
						<input type="text" class="form-control "id="telefono" name="telefono" placeholder="Numero De telefono" 
							required="true" maxlength="12">
					</div>
					<hr>
					<div class="form-group">
						<label for="serial">Serial:</label>
						<input type="text" class="form-control "id="serial" name="serial" placeholder="Serial Del equipo" 
							required="true" maxlength="15">
					</div>	
					
					<div class="form-group">
						<label for="serial">Marca:</label>
						<input type="text" class="form-control textoMayuscula" id="marca" name="marca" placeholder="Marca del equipo" 
							required="true" maxlength="20">
					</div>

					<div class="form-group">
						<label for="serial">Modelo:</label>
						<input type="text" class="form-control textoMayuscula" id="modelo" name="modelo" placeholder="Modelo del equipo" 
							required="true" maxlength="25">
					</div>
					<hr>
						<div class="form-group">
							<label>Memoria SD: <br>
								<input type="radio" id="memorias" name="memoria" value="si">SI 
							</label>
							<label>
								<input type="radio" id="memorian" name="memoria" value="no" checked="true">NO 
							</label>
						</div>
						<div class="form-group">
							<label>SIM Card: <br>
								<input type="radio" id="chips" name="chip" value="si">SI
							</label>
							<label>
								<input type="radio" id="chipn" name="chip" value="no" checked="true">NO
							</label>
						</div>
						<div class="form-group">
							<label>Tapa: <br>
								<input type="radio" id="tapas" name="tapa" value="si" checked="true">SI
							</label>
							<label>
								<input type="radio" id="tapan" name="tapa" value="no">NO 
							</label>	
						</div>
					
					<hr>
					<div class="form-group">
					<label>Falla(s)</label><br>
					<textarea name="falla" class="form-control textoMayuscula" id="falla" name="falla" rows="5" cols="25" required wrap="soft" maxlength="50"
						maxlength="50"></textarea>
					
					<select name="tecnicos" class="form-control" id="tecnicos">
						<option value="nada" selected="true" disabled="true">-- Tecnicos</option>
						<?php  
							mysql_connect('localhost','gory','Darkgo13');
							mysql_select_db('cl55-cell');
							$sql = mysql_query("SELECT * FROM tecnicos");
							while($row = mysql_fetch_array($sql)){
								echo "<option value='".$row['id_tec']."'>" . $row['nombre'] . "</option>";
							}
						?>
					</select>

					<label>Observacion(es)</label><br>
					<textarea name="observacion" class="form-control textoMayuscula" id="observacion" name="observacion" rows="5" cols="25" 
						wrap="soft" maxlength="80" maxlength="80"></textarea>
					</div>
					<hr>
					<input type="submit" class="btn btn-success btn-lg" name="crear" value="Crear Orden">
					<input type="reset" class="btn btn-primary btn-lg" value="Limpiar Formulario"><br>
	
					<div id="escondido" >
						<br> Status: <br>
						<input type="radio" id="srecibido" name="status" value="recibido" checked="true">RECIBIDO <br>
						<input type="radio" id="sreparado" name="status" value="reparado">REPARADO <br>
						<input type="radio" id="sentregado" name="status" value="entregado">ENTREGADO <br>
						<input type="radio" id="cliente_enc" name="cliente_enc" value="encontrado">Cliente encontrado <br>
						<input type="radio" id="cliente_enc" name="cliente_enc" value="nencontrado" checked="true">Cliente NO encontrado <br>
						<input type="radio" id="equipo_enc" name="equipo_enc" value="encontrado">Equipo encontrado <br>
						<input type="radio" id="cliente_enc" name="equipo_enc" value="nencontrado" checked="true">Equipo NO encontrado <br>
					</div>
				</form>	
			</div>
		</div>
	</div>
	

	<!-- Para al salir del campo cedula buscar en la base de datos si ya tiene registrado el cliente -->
		<script src="js/jquery-1.12.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.maskedinput.js"></script>
		<script src="js/global.js"></script>
</body>
</html>