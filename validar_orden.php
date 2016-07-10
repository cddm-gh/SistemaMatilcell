<?php 

session_start();
use Dompdf\Dompdf;

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if(isset($_POST['crear'])){
	//Asignando las variables
	$cedula = trim($_POST['cedula']);
	$nombre = strtoupper(trim($_POST['nombre']));
	$telefono = trim($_POST['telefono']);
	$serial = trim($_POST['serial']);
	$marca = strtoupper(trim($_POST['marca']));
	$modelo = strtoupper(trim($_POST['modelo']));
	$memoria = strtoupper($_POST['memoria']);
	$tapa = strtoupper($_POST['tapa']);
	$chip = strtoupper($_POST['chip']);
	$id_tec = $_POST['tecnicos'];
	$falla = strtoupper(trim($_POST['falla']));
	$observacion = strtoupper(trim($_POST['observacion']));
	$status = trim($_POST['status']);
	$fecha = date("Y-m-d",strtotime($_POST['fecha']));
	$costo = trim($_POST['total']);
	$abono = trim($_POST['abono']);
	$resta = trim($_POST['resta']);
	$tipo_pago = $_POST['pagos'];
	$cliente_enc = $_POST['cliente_enc'];
	$equipo_enc = $_POST['equipo_enc'];


	//Validar que las variables no esten vacias
	if(empty($cedula) or empty($nombre) or empty($telefono) or empty($serial) or empty($marca) or empty($modelo)
		or empty($falla) or empty($memoria) or empty($tapa) or empty($chip) or empty($costo)){
		echo "<h1>Error no puede dejar campos vacios!</h1><br>";
		header('Location: orden.php');
	}else{
		//Si el nombre tiene un formato valido NOMBRE APELLIDO y solo letras
		if(preg_match('/^[a-zA-Z\s]+$/',$nombre)){

		
			require dirname(__FILE__).'/db/connect.php';
			//Se debe insertar primero el cliente y el equipo
			//ya que en la tabla ordenes se usan llaves foraneas y de no ser asi no permitira insertar
			if($cliente_enc == 'nencontrado'){
				$statement = $conexion->prepare('INSERT INTO clientes VALUES (:cedula,:nombre,:telefono)');
				$statement->execute(array(
					':cedula' => $cedula,
					':nombre' => $nombre,
					':telefono' => $telefono
				));
			}

			if($equipo_enc == 'nencontrado'){
				$statement = $conexion->prepare('INSERT INTO equipos VALUES (:serial,:marca,:modelo)');
				$statement->execute(array(
					':serial' => $serial,
					':marca' => $marca,
					':modelo' => $modelo
				));
			}
			$st = $conexion->prepare('INSERT INTO caracteristicas VALUES (0,:serial_eq,:chip,:memoria,:tapa,:falla,:observacion)');
			$st->execute(array(
				':serial_eq' => $serial,
				':chip' => $chip,
				':memoria' => $memoria,
				':tapa' => $tapa,
				':falla' => $falla,
				':observacion' => $observacion
			));
			$id_caracteristicas = $conexion->lastInsertId();
			
			$st = $conexion->prepare('INSERT INTO pagos VALUES (0,:total,:abono,:restante,:tipo)');
			$st->execute(array(
				':total' => $costo,
				':abono' => $abono,
				':restante' => $resta,
				':tipo' => $tipo_pago
			));
			$id_pago = $conexion->lastInsertId();

			try{

				$statement = $conexion->prepare('INSERT INTO ordenes VALUES (0,:cedula,:serial_eq,:id_car,:id_tec,:id_pago,:fecha)');
				$statement->execute(array(
					':cedula' => $cedula,
					':serial_eq' => $serial,
					':id_car' => $id_caracteristicas, //regresa el ID de las ultimas caracteristicas agregadass
					':id_tec' => $id_tec,
					':id_pago' => $id_pago,
					':fecha' => $fecha
					)
				);
				$ultima_orden = $conexion->lastInsertId();
				$statement = $conexion->prepare('INSERT INTO reparaciones VALUES (0,:norden,:status,:fecha)');
				$statement->execute(array(
					':norden' => $ultima_orden,
					':status' => "Recibido",
					':fecha' => $fecha
				));
				
				//Crear el reporte de la orden para entregar al cliente
				require_once dirname(__FILE__).'/dompdf/autoload.inc.php';
				$codigoHTML = '
					<html>
						<head>
							<meta charset="UTF-8">
							<link rel="stylesheet" href="css/estilo_reportes.css">
						</head>
						<body>
							<table>
								<tr>
									<th class="etiqueta">Fecha:</th>
									<th class="etiqueta">'.$fecha.'</th>
									<th></th>
									<th></th>
									<th></th>
									<th class="etiqueta">Orden#</th>
									<th></th>
									<th class="etiqueta">'.$ultima_orden.'</th>
								</tr>
								<tr>
									<td class="etiqueta">Datos del Cliente</td>
									<td></td>
									<td></td>
									<td></td>
									<td class="etiqueta">Datos del Equipo</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td class="etiqueta">Cédula:</td>
									<td>'.$cedula.'</td>
									<td class="etiqueta"></td>
									<td class="etiqueta">Serial:</td>
									<td>'.$serial.'</td>
									<td></td>
									<td class="etiqueta">Memoria:</td>
									<td>'.$memoria.'</td>
								</tr>
								<tr>
									<td class="etiqueta">Nombre:</td>
									<td>'.$nombre.'</td>
									<td></td>
									<td class="etiqueta">Marca:</td>
									<td>'.$marca.'</td>
									<td></td>
									<td class="etiqueta">CHIP:</td>
									<td>'.$chip.'</td>
								</tr>
								<tr>
									<td class="etiqueta">Teléfono:</td>
									<td>'.$telefono.'</td>
									<td></td>
									<td class="etiqueta">Modelo:</td>
									<td>'.$modelo.'</td>
									<td></td>
									<td class="etiqueta">Tapa:</td>
									<td>'.$tapa.'</td>
								</tr>
								<tr>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
									<td>-</td>
								</tr>
								<tr>
									<td class="etiqueta">Técnico:</td>
									<td>'.$id_tec.'</td>
									<td></td>
									<td></td>
									<td></td>
									<td class="etiqueta">Total:</td>
									<td>'.$costo.'</td>
									<td></td>
								</tr>
								<tr>
									<td class="etiqueta">Falla:</td>
									<td>'.$falla.'</td>
									<td></td>
									<td></td>
									<td></td>
									<td class="etiqueta">Abono:</td>
									<td>'.$abono.'</td>
									<td></td>
								</tr>
								<tr>
									<td class="etiqueta">Observación:</td>
									<td>'.$observacion.'</td>
									<td></td>
									<td></td>
									<td></td>
									<td class="etiqueta">Resta:</td>
									<td>'.$resta.'</td>
									<td></td>
								</tr>
								<hr>
							</table>
						</body>
					</html>
				';
				
				$codigoHTML = utf8_decode(utf8_encode($codigoHTML));
				$dompdf = new Dompdf();
				$dompdf->loadHtml($codigoHTML);
				ini_set("memory_limit","128M");
				$dompdf->render();
				$dompdf->stream("Reparaciones_Tecnicos",array('Attachment'=>0));

			}catch(PDOException $e){
				echo "<h2> No se pudo crear la orden " . $e->getMessage() . "</h2>";
			}
			
			echo "<h1>Orden creada con éxito!</h1>";
		//fin regexp
		}else{
			echo "<h1>No coincide con el formato de nombre verifique.</h1><br>";
		}
	}
	

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Validación de la Orden</title>
</head>
<body>
	<script>
		window.setTimeout(function() {
			window.location = 'orden.php';
		}, 1000);
	</script>
</body>
</html>