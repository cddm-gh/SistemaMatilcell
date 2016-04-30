<?php 

session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

if(isset($_POST['crear'])){
	//Asignando las variables
	$cedula = trim($_POST['cedula']);
	$nombre = trim($_POST['nombre']);
	$telefono = trim($_POST['telefono']);
	$serial = trim($_POST['serial']);
	$marca = trim($_POST['marca']);
	$modelo = trim($_POST['modelo']);
	$memoria = $_POST['memoria'];
	$tapa = $_POST['tapa'];
	$chip = $_POST['chip'];
	$id_tec = $_POST['tecnicos'];
	$falla = trim($_POST['falla']);
	$observacion = trim($_POST['observacion']);
	$status = trim($_POST['status']);
	$cliente_enc = $_POST['cliente_enc'];
	$equipo_enc = $_POST['equipo_enc'];
	//Validar que las variables no esten vacias
	if(empty($cedula) or empty($nombre) or empty($telefono) or empty($serial) or empty($marca) or empty($modelo)
		or empty($falla) or empty($memoria) or empty($tapa) or empty($chip)){
		echo "<h1>Error no puede dejar campos vacios!</h1><br>";
		header('Location: orden.php');
	}else{
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

		try{

			$statement = $conexion->prepare('INSERT INTO ordenes VALUES (0,:cedula,:serial_eq,:id_tec,:memoria,:chip,:tapa,:falla,
				:observacion,:status)');
			$statement->execute(array(
				':cedula' => $cedula,
				':serial_eq' => $serial,
				':id_tec' => $id_tec,
				':memoria' => $memoria,
				':chip' => $chip,
				':tapa' => $tapa,
				':falla' => $falla,
				':observacion' => $observacion,
				':status' => $status
				)
			);

		}catch(PDOException $e){
			echo "<h2> No se pudo crear la orden " . $e->getMessage();
		}

	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validacion de la Orden</title>
</head>
<body>
	
	<p><h1>Orden creada con exito!</h1></p>
	<script>
	window.setTimeout(function() {
		window.location = 'orden.php';
	}, 2000);
	</script>
</body>
</html>