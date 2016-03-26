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
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<form action="validar_orden.php" method="POST" name="orden">
		<label for="cedula">Cedula:</label>
		<input type="text" id="cedula" name="cedula" placeholder="Numero De cedula" required="true" autofocus="true" maxlength="9"><br>

		<label for="nombre">Nombre:</label>
		<input type="text" class="textoMayuscula" id="nombre" name="nombre" placeholder="Nombre del cliente" required="true" 
			maxlength="45"><br>

		<label for="telefono">Telefono:</label>
		<input type="text" id="telefono" name="telefono" placeholder="Numero De telefono" required="true" maxlength="12"><br>
		<hr>

		<label for="serial">Serial:</label>
		<input type="text" id="serial" name="serial" placeholder="Serial Del equipo" required="true" maxlength="15"><br>

		<label for="serial">Marca:</label>
		<input type="text" class="textoMayuscula" id="marca" name="marca" placeholder="Marca del equipo" required="true" maxlength="20"><br>

		<label for="serial">Modelo:</label>
		<input type="text" class="textoMayuscula" id="modelo" name="modelo" placeholder="Modelo del equipo" required="true" maxlength="25"><br>
		<hr>
		Memoria SD:
		<input type="radio" id="memorias" name="memoria" value="si">SI 
		<input type="radio" id="memorian" name="memoria" value="no" checked="true">NO <br>
		SIM Card:
		<input type="radio" id="chips" name="chip" value="si">SI 
		<input type="radio" id="chipn" name="chip" value="no" checked="true">NO <br>
		Tapa:
		<input type="radio" id="tapas" name="tapa" value="si" checked="true">SI 
		<input type="radio" id="tapan" name="tapa" value="no">NO <br>
		<br>Falla(s): <br>
		<textarea name="falla" class="textoMayuscula" id="falla" name="falla" rows="5" cols="25" required wrap="soft" maxlength="50"
			maxlength="50"></textarea><br>
		
		<select name="tecnicos" id="tecnicos">
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

		<br>Observacion(es): <br>
		<textarea name="observacion" class="textoMayuscula" id="observacion" name="observacion" rows="5" cols="25" wrap="soft" maxlength="80"
			maxlength="80"></textarea>

		<br> Status: <br>
		<input type="radio" id="srecibido" name="status" value="recibido" checked="true">RECIBIDO <br>
		<input type="radio" id="sreparado" name="status" value="reparado">REPARADO <br>
		<input type="radio" id="sentregado" name="status" value="entregado">ENTREGADO <br>
		<hr>
		<input type="submit" name="crear" value="Crear Orden">
		<input type="reset" value="Limpiar Formulario"><br>

		<div id="escondido" >
			<input type="radio" id="cliente_enc" name="cliente_enc" value="encontrado">Cliente encontrado <br>
			<input type="radio" id="cliente_enc" name="cliente_enc" value="nencontrado" checked="true">Cliente NO encontrado <br>
			<input type="radio" id="equipo_enc" name="equipo_enc" value="encontrado">Equipo encontrado <br>
			<input type="radio" id="cliente_enc" name="equipo_enc" value="nencontrado" checked="true">Equipo NO encontrado <br>
		</div>
	</form>

	<!-- Para al salir del campo cedula buscar en la base de datos si ya tiene registrado el cliente -->
		<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
		<script src="js/global.js"></script>
</body>
</html>