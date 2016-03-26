<?php 
	if(isset($_POST['cedula']) === true && empty($_POST['cedula']) === false){
		$ced = mysql_real_escape_string(trim($_POST['cedula']));
		require '../db/connect.php';
		$statement = $conexion->prepare('SELECT * FROM clientes WHERE cedula = :cedula');
		$statement->execute(array(
			':cedula' => $ced
		));

		$resultado = $statement->fetch();

		if($resultado != false){
			echo $resultado[1]."/".$resultado[2];
		}
		$statement->close();
	}

	if(isset($_POST['serial']) === true && empty($_POST['serial']) === false){
		$ser = mysql_real_escape_string(trim($_POST['serial']));
		require '../db/connect.php';
		$statement = $conexion->prepare('SELECT * FROM equipos WHERE serial = :serial');
		$statement->execute(array(
			':serial' => $ser
		));

		$resultado2 = $statement->fetch();

		if($resultado2 != false){
			echo $resultado2[1]."/".$resultado2[2];
		}
		$statement->close();
	}
?>