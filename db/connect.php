<?php 
	try {
		//Datos para realizar la conexion
		$dbhost = 'localhost';
		$dbname = 'cl55-cell';
		$dbuser = 'gory';
		$dbpass = 'Darkgo13';
		
		$conexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

	} catch (PDOException $e) {
		echo "Error " . $e->getMessage();
	}
?>