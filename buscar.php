<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

	
	if(isset($_POST['cedula']) === true && empty($_POST['cedula']) === false){
		$ced = trim($_POST['cedula']);
		require dirname(__FILE__).'/db/connect.php';
		$statement = $conexion->prepare('SELECT * FROM clientes WHERE cedula = :cedula;');
		$statement->execute(array(
			':cedula' => $ced
		));
		$resultado = $statement->fetch();
		//var_dump($ced);
		if($resultado != false){
			echo $resultado[1]."/".$resultado[2];
		}else
			echo "";
	}

	if(isset($_POST['serial']) === true && empty($_POST['serial']) === false){
		$ser = trim($_POST['serial']);
		require dirname(__FILE__).'/db/connect.php';
		$statement = $conexion->prepare('SELECT * FROM equipos WHERE serial = :serial;');
		$statement->execute(array(
			':serial' => $ser
		));

		$resultado2 = $statement->fetch();

		if($resultado2 != false){
			echo $resultado2[1]."/".$resultado2[2];
		}else
			echo "";
	}
?>