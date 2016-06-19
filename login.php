<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

if(isset($_SESSION['usuario'])){
	header('Location: index.php');
}

$errores = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password = filter_var($password, FILTER_SANITIZE_STRING);

        require dirname(__FILE__).'/db/connect.php';

	$statement = $conexion->prepare("SELECT * FROM empleados WHERE usuario = :usuario AND password = :password");
	$statement->execute(array(
		':usuario' => $usuario,
		':password' => $password
	));

	$resultado = $statement->fetch();

	if($resultado != false){
		$_SESSION['usuario'] = $usuario;
		header('Location: index.php');
	}else{
		$errores .= 'Nombre de usuario o password incorrecto, por favor intente nuevamente';
	}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login del Sistema</title>
	<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	
	<div class="container">
		<br>
		<header id="cabecera">
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
							<span class="sr-only">Menú</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="#" class="navbar-brand" title="Mundo Matilcell">
							<img style="max-width:200px; max-height: 200px;" src="imgs/logomm.png" class="img-responsive">
						</a>
					</div>

					<div class="collapse navbar-collapse" id="navbar-1">
						
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  
							class="navbar-form navbar-right" method="POST" name="login">
								
							<div class="form-group has-feedback">
								<label class="control-label" for="usuario"></label>
								<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" maxlenght="10">
								<i class="glyphicon glyphicon-user form-control-feedback"></i>
							</div>
							<div class="form-group has-feedback">
								<label class="control-label" for="usuario"></label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Password" maxlenght="10">
								<i class="glyphicon glyphicon-lock form-control-feedback"></i>
							</div>
							<button type="submit" class="btn btn-success" value="entrar">Entrar
								<span class="glyphicon glyphicon-log-in"></span>
							</button>
						</form>
				
					</div>

				</div>
			</nav>
		</header>

		<?php
			if( $errores !== ""){
				echo '<div class="alert alert-danger">'; 
				echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
				echo " " . $errores; 
				echo '</div>';
			}
		?>
		<div class="jumbotron">
			<img src="imgs/logomm.png" class="img img-responsive" alt="Logo Mundo Matilcell">
		</div>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/global.js"></script>
</body>
</html>