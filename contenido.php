<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema de Ordenes Mundo Matilcell</title>
</head>
<body>
	<div class="contenedor">
		<h1 class="titulo">Contenido del sitio</h1>
		<a href="cerrar.php">Cerrar Sesion</a>
		<hr class="border">
		<div class="contenido">
			<article>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dicta iste veritatis enim quisquam 
				architecto natus excepturi reprehenderit placeat quas aperiam, doloribus, modi officia ex ducimus inventore quibusdam provident facere.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit molestias quaerat alias blanditiis 
				consequuntur laboriosam, voluptatem numquam dignissimos minima perspiciatis! Obcaecati neque tenetur exercitationem asperiores quas architecto commodi quidem, nihil!</p>
			</article>
		</div>
	</div>
</body>
</html>