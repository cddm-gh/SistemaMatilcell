<?php 
session_start();

if(isset($_SESSION['usuario'])){
	header('Location: index.php');
}

$errores = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password = filter_var($password, FILTER_SANITIZE_STRING);

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

	$statement = $conexion->prepare('SELECT * FROM empleados WHERE usuario = :usuario AND password = :password');
	$statement->execute(array(
		':usuario' => $usuario,
		':password' => $password
	));

	$resultado = $statement->fetch();

	if($resultado != false){
		$_SESSION['usuario'] = $usuario;
		header('Location: index.php');
	}else{
		$errores .= '<li>Datos incorrectos.</li>';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login del Sistema</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="login">
		<input type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario"><br>
		<input type="password" name="password" id="password" placeholder="Password"><br>
		<input type="submit" value="Entrar">
	</form>	
</body>
</html>