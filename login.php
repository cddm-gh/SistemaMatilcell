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
		$errores .= '<li>Datos incorrectossssssss.</li>';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login del Sistema</title>
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
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="#" class="navbar-brand">
							Mundo Matilcell
						</a>
					</div>

					<div class="collapse navbar-collapse" id="navbar-1">
						
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  
							class="navbar-form navbar-right" method="POST" name="login">
							<div class="form-group">
								<input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre de Usuario">
								<input type="password" name="password" class="form-control" id="password" placeholder="Password">
							</div>
							<input type="submit" class="btn btn-success" value="Entrar">
						</form>
				
					</div>

				</div>
			</nav>
		</header>

		<section>
			<ul><?php echo $errores; ?></ul>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias obcaecati vel porro, reprehenderit doloremque laudantium esse eligendi quod aliquid consequatur, officiis velit! Nam reiciendis nostrum dolor distinctio consequatur veritatis, sequi optio atque ratione minima incidunt ad beatae veniam fugit, pariatur consequuntur illum dignissimos natus explicabo alias. Dolores minima ullam, quas magni, vitae inventore voluptatem officiis dicta est omnis quibusdam, facilis rem illo voluptatum sapiente. Possimus, deserunt ex eos explicabo, error nemo doloremque delectus laboriosam, aliquam, eum numquam quam porro praesentium corrupti a! Voluptates ab sapiente incidunt, harum illum dolorem, culpa hic, illo similique iste molestias aut temporibus. Facere beatae iusto praesentium id eveniet unde dolorum, voluptatum iure. Molestiae rerum reprehenderit odio fugiat nihil quae ea autem, expedita facilis a doloribus cupiditate aspernatur amet facere, sit, ipsa nemo praesentium. Esse laboriosam error ex tenetur consequatur saepe corporis minima repudiandae velit cupiditate corrupti, tempora est modi, atque nihil nostrum architecto amet similique aut quam, facere nulla a numquam culpa. Nihil doloribus molestiae ullam molestias commodi modi consequatur, eum est et porro eligendi possimus earum repellendus asperiores amet similique facere. Assumenda unde laboriosam officia, voluptas maiores, nemo obcaecati ipsum asperiores quasi quos dolore minima veritatis, perferendis. Totam optio nulla soluta perferendis nisi qui.
			</p>
		</section>
	</div>

	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/global.js"></script>
</body>
</html>