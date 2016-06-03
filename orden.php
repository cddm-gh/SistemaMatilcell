<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}else{
	require_once dirname(__FILE__).'/db/connect.php';
	$statement = $conexion->prepare('SELECT * FROM tecnicos');
	$statement->execute();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Creación de Ordenes</title>
	<!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div class="container">
		<br>
		<div class="progress">
			<div class="progress-bar progress-bar-striped active" id="barra" role="progressbar" aria-valuemax="100">
				
			</div>
		</div>
		<div class="row">			

				<form action="validar_orden.php" method="POST" name="orden">
					<div class="col-md-3">
						<div class="form-group has-feedback">
							<label for="cedula">Cédula:</label>
							
							<input type="text" class="form-control input-principal" id="cedula" name="cedula" placeholder="Numero De Cedula" required="true"
								autofocus="true" maxlength="9">	
							<i class="glyphicon glyphicon-user form-control-feedback"></i>						
						</div>

						<div class="form-group has-feedback">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control textoMayuscula" id="nombre" name="nombre" placeholder="Nombre del cliente"
								required="true" maxlength="30">
							<i class="glyphicon glyphicon-font form-control-feedback"></i>
						</div>

						<div class="form-group has-feedback">
							<label for="telefono">Teléfono:</label>
							<input type="text" class="form-control "id="telefono" name="telefono" placeholder="Numero De telefono"
								required="true" maxlength="12">
							<i class="glyphicon glyphicon-earphone form-control-feedback"></i>
						</div>
						<hr>
					</div>
					<div class="col-md-3">
						<div class="form-group has-feedback">
							<label for="serial">Serial:</label>
							<input type="text" class="form-control input-principal"id="serial" name="serial" placeholder="Serial Del equipo"
								required="true" maxlength="15">
							<i class="glyphicon glyphicon-barcode form-control-feedback"></i>
						</div>

						<div class="form-group has-feedback">
							<label for="serial">Marca:</label>
							<input type="text" class="form-control textoMayuscula" id="marca" name="marca" placeholder="Marca del equipo"
								required="true" maxlength="20">
							<i class="glyphicon glyphicon-list-alt form-control-feedback"></i>
						</div>

						<div class="form-group has-feedback">
							<label for="serial">Modelo:</label>
							<input type="text" class="form-control textoMayuscula" id="modelo" name="modelo" placeholder="Modelo del equipo"
								required="true" maxlength="20">
							<i class="glyphicon glyphicon-tag form-control-feedback"></i>
						</div>
						<hr>
					</div>
					<div class="col-md-1">
						<div class="form-group">
							<label>Memoria:</label><br>
							<input type="radio" id="memorias" name="memoria" value="si">SI
							<input type="radio" id="memorian" name="memoria" value="no" checked="true">NO
						</div>
						<div class="form-group">
							<label>SIM:</label><br>
							<input type="radio" id="chips" name="chip" value="si">SI
							<input type="radio" id="chipn" name="chip" value="no" checked="true">NO
						</div>
						<div class="form-group">
							<label>Tapa:</label><br>
							<input type="radio" id="tapas" name="tapa" value="si" checked="true">SI
							<input type="radio" id="tapan" name="tapa" value="no">NO
						</div>
						<hr>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						<label>Falla(s)</label><br>
						<textarea name="falla" class="form-control textoMayuscula" id="falla" name="falla" rows="5" cols="25" required wrap="soft" maxlength="50"
							maxlength="50"></textarea>
						<br>
                        <label for="tecnicos">Reparar Con:</label>
						<select name="tecnicos" class="form-control" id="tecnicos">
							<option value="nada" selected="true" disabled="true">-- Técnicos</option>
							<?php
								while($row = $statement->fetch()){
									echo "<option value='".$row['id_tec']."'>" . $row['nombre'] . "</option>";
								}
							?>
						</select><br>

						<label>Observación</label><br>
						<textarea name="observacion" class="form-control textoMayuscula" id="observacion" name="observacion" rows="5" cols="25"
							wrap="soft" maxlength="80" maxlength="80"></textarea>
						</div>
						<hr>
					</div>

					<div class="col-md-2">
						<label>Total:</label><br>
						<div class="form-group">
							<input type="number" class="form-control" name="total" id="total" placeholder="Cantidad a pagar" required="true"
								min="200" step="50">
						</div>
						<div class="form-group">
							<input type="number" class="form-control" name="abono" id="abono" placeholder="Cantidad abonada"
								min="0">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="resta" id="resta" placeholder="Cantidad restante" readonly>
						</div>
						<div class="form-group">
							<select name="pagos" class="form-control" id="pagos">
								<option value="nada" selected="true" disabled="true">-- Tipos de pago</option>
								<option value="efectivo">Efectivo</option>
								<option value="debito">Débito</option>
								<option value="credito">Crédito</option>
								<option value="cheque">Cheque</option>
								<option value="transferencia">Transferencia</option>
							</select>
						</div>
						
						<div class="control-group">
							<label for="fecha" class="control-label">Fecha</label>
							<div class="controls">
								<div class="input-group">
									<label for="fecha" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

									</label>
									<input id="fecha" name="fecha" type="text" class="form-control" readonly/>
								</div>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-2">
							<button type="submit" class="btn btn-success btn-lg" name="crear" id="crear">Crear Orden 
								<span class="glyphicon glyphicon-save"></span>
							</button>
							<button type="reset" class="btn btn-primary btn-lg" value="limpiar">Limpiar Campos
								<span class="glyphicon glyphicon-erase"></span>
							</button>
						</div>
					</div>
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
	

	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- Plugins para controlar las fechas -->
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
	<!--Plugin para enmascarar los inputs-->
	<script src="js/jquery.maskedinput.js"></script>
	<!-- Script para iniciar los plugins que se usan al cargar las pagina -->
	<script src="js/global.js"></script>	
</body>
</html>