<?php
use Project\Helpers\Config;
require dirname(__FILE__).'/'.'../app/Config.php';

$config = new Config;
$config->load('config.php');

try {
	//Datos para realizar la conexion
	$dbhost = $config->get('db.hosts.local');
	$dbname = $config->get('db.name'); 
	$dbuser = $config->get('db.user'); 
	$dbpass = $config->get('db.password'); 
		
	$conexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

} catch (PDOException $e) {
	echo "Error " . $e->getMessage();
}	
?>