<?php
session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

$msj = ""; 
$errores = "";

if(isset($_POST['guardar'])){
    $nombre = $_POST['nombre'];
    $rol = $_POST['cargo'];
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $privilegios = $_POST['privilegios'];
    
    if($password1 !== $password2)
        $errores .= "Las contraseñas no coinciden!";
    else{
        $password1 = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
        require_once dirname(__FILE__).'/db/connect.php';
        
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
            $statement = $conexion->prepare("INSERT INTO empleados VALUES (0,:nombre,:usuario,:password,:cargo,:priv)");
            $resultado = $statement->execute(array(
                ':nombre' => $nombre,
                ':usuario' => $usuario,
                ':password' => $password1,
                ':cargo' => $rol,
                ':priv' => $privilegios
            ));
        
            if( $resultado )
                $msj .= " Empleado guardado en la base de datos.";
        
        }catch(PDOException $e){
            $errores .= "Ocurrió un error al guardar el empleado - " . $e->getMessage();
        }
    }
}

if(isset($_POST['guardartec'])){
    $nombretec = $_POST['nombretec'];
    $cargotemp = $_POST['cargostecnicos'];
    $cargo = "";
    
    if($cargotemp == "tecrep")
        $cargo = "Técnico de Reparación";
    
    if($cargotemp == "tecsoft")
        $cargo = "Técnico de Software";
        
   
    require_once dirname(__FILE__).'/db/connect.php';
        
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $statement = $conexion->prepare("INSERT INTO tecnicos VALUES (0,:nombre,:cargo)");
        $resultado = $statement->execute(array(
            ':nombre' => $nombretec,
            ':cargo' => $cargo
        )); 
        if( $resultado )
            $msj .= "Técnico guardado con éxito en la base de datos.";
        
    }catch(PDOException $e){
            $errores .= "Ocurrió un error al guardar el empleado - " . $e->getMessage();
    }   
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Area Administrativa</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>				
                    <a class="navbar-brand" href="contenido.php"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="contenido.php">Inicio</a></li>
                        <li><a href="orden.php">Crear Orden</a></li>
                        <li><a href="consultar_ordenes.php">Ver Ordenes</a></li>
                        <li><a href="consultar_clientes.php">Ver Clientes</a></li>
                        <li><a href="reportes.php">Reportes</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="cerrar.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
                    </ul>
                </div>							
                </div>					
            </nav>
        </div>
        <div class="row">
            <?php
				if( $errores !== ""){
					echo '<div class="alert alert-danger">'; 
					echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
					echo " " . $errores; 
					echo '</div>';
				}
                if( $msj !== ""){
                    echo '<div class="alert alert-success">'; 
					echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
					echo " " . $msj; 
					echo '</div>';
                }
			?>
        </div>
        <hr>
        
        <div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="nombre">Nombre Empleado</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre y Apellido del empleado" 
                            required="true" maxlength="45">
                        <i class="glyphicon glyphicon-font form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="telefono">Cargo Empleado</label>
                        <input type="text" id="cargo" name="cargo" class="form-control" placeholder="Cargo que desempeña" 
                            required="true" maxlength="30">
                        <i class="glyphicon glyphicon-briefcase form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="telefono">Nombre Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Nombre usuario para ingresar al sistema" 
                            required="true" maxlength="15">
                        <i class="glyphicon glyphicon-user form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="telefono">Contraseña</label>
                        <input type="text" id="password1" name="password1" class="form-control" placeholder="Contraseña para ingresar al sistema" 
                            required="true" maxlength="25">
                        <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="telefono">Repita contraseña</label>
                        <input type="text" id="password2" name="password2" class="form-control" placeholder="Contraseña para ingresar al sistema" 
                            required="true" maxlength="25">
                        <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="privilegios">Seleccione los privilegios para el empleado</label>
                        <select name="privilegios" id="privilegios" class="form-control">
                            <option value="1">Administrador</option>
                            <option value="2" selected="true">No Administrador</option>
                        </select>
                    </div>
                    
                    <div class="col-md-12 col-md-offset-2">
                        <button type="submit" id="guardar" name="guardar" class="btn btn-primary">Guardar 
                            <span class="glyphicon glyphicon-save"></span>
                        </button>
                        <button type="reset" id="limpiar" name="limpiar" class="btn btn-warning">Limpiar 
                            <span class="glyphicon glyphicon-erase"><span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="col-md-4">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    
                        <div class="form-group has-feedback">
                            <label for="nombretec">Nombre del Técnico</label>
                            <input type="text" class="form-control" name="nombretec" id="nombretec" maxlength="30" required="true">
                            <i class="glyphicon glyphicon-font form-control-feedback"></i>
                        </div>
                        <div class="form-group has-feedback">
                            <select name="cargostecnicos" class="form-control" id="cargostecnicos">
                                <option value="nada" selected="true" disabled="true">-- Cargo del Técnico</option>
                                <option value="tecrep">Técnico de Reparación</option>
                                <option value="tecsoft">Técnico de Software</option>
                            </select>
                        </div>
                        <button type="submit" id="guardar" name="guardartec" class="btn btn-primary">Guardar Técnico
                            <span class="glyphicon glyphicon-save"></span>
                        </button>
                    
                </form>
                
                <label for="nomtec">Seleccione el Técnico que desea elimiar</label>
                <select name="nomtec" id="nomtec" class="form-control">
                    <option value="nada" selected="true" disabled="true">-- Técnicos</option>
					<?php
                        require_once dirname(__FILE__).'/db/connect.php';
	                    $statement = $conexion->prepare('SELECT * FROM tecnicos');
	                    $statement->execute();
                        
                        while($row = $statement->fetch()){
							echo "<option value='".$row['id_tec']."'>" . $row['nombre'] . "</option>";
						}
                    ?>
				</select><br>
                <button type="button" id="elimar_tecnico" class="btn btn-danger" onclick="eliminarTecnico()">Eliminar Técnico
                    <span class="glyphicon glyphicon-trash"></span>
                </button> 
                <label for="nomemp">Seleccione el Empleado que desea elimiar</label>
                <select name="nomemp" id="nomemp" class="form-control">
                    <option value="nada" selected="true" disabled="true">-- Empleados</option>
					<?php
                        require_once dirname(__FILE__).'/db/connect.php';
	                    $statement = $conexion->prepare('SELECT * FROM empleados');
	                    $statement->execute();
                        
                        while($row = $statement->fetch()){
							echo "<option value='".$row['id_emp']."'>" . $row['nombre'] . "</option>";
						}
                    ?>
				</select><br>
                <button type="button" id="elimar_empleado" class="btn btn-danger" onclick="eliminarEmpleado()">Eliminar Empleado
                    <span class="glyphicon glyphicon-trash"></span>
                </button>

            </div>
        </div>
        <hr>
        
    </div>
    
    <script src="js/jquery-1.12.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--Plugin para enmascarar los inputs-->
	<script src="js/jquery.maskedinput.js"></script>
    <script src="js/global.js"></script>
    <script src="js/eliminar_et.js"></script>
</body>
</html>