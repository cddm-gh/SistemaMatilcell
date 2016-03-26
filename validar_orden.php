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
	//Validar que las variables no esten vacias
	if(empty($cedula) or empty($nombre) or empty($telefono) or empty($serial) or empty($marca) or empty($modelo)
		or empty($falla) or empty($memoria) or empty($tapa) or empty($chip)){
		echo "<h1>Error no puede dejar campos vacios!</h1><br>";
		echo '<a href="orden.php">Volver al formulario.';
	}else{
		try{
			require '/db/connect.php';
			$statement = $conexion->prepare('INSERT INTO ordenes VALUES(0,:cedula,:serial_eq,:id_tec,:memoria,:chip,:tapa,:falla,
				:observaciones,:status)');
			$statement->execute(array(
				':cedula' => $cedula,
				':serial_eq' => $serial,
				':id_tec' => $id_tec,
				':memoria' => $memoria,
				':chip' => $chip,
				':tapa' => $tapa,
				':fallass' => $falla,
				':observaciones' => $observacion,
				':status' => $status
				)
			);
			echo "<h1>Orden creada!</h1><br>";
			echo '<a href="orden.php">Volver al formulario.';
		}catch(PDOException $e){
			echo "<h2> No se pudo crear la orden " . $e->getMessage();
		}

	}

}

?>