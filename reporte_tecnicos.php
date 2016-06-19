<?php
session_start();
use Dompdf\Dompdf;
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}else{
    if(isset($_POST['generar'])){
        $fecha1 = date("Y-m-d",strtotime($_POST['fecha_inicial']));
        $fecha2 = date("Y-m-d",strtotime($_POST['fecha_final']));
            require dirname(__FILE__).'/db/connect.php';
            require_once dirname(__FILE__).'/dompdf/autoload.inc.php';

            
            $statement = $conexion->prepare('
                SELECT COUNT(*),t.nombre FROM reparaciones r 
                INNER JOIN ordenes o ON r.n_orden = o.numero
                INNER JOIN tecnicos t ON o.id_tec = t.id_tec 
                WHERE r.status LIKE "Reparado%" AND r.fecha BETWEEN :fecha1 AND :fecha2 GROUP BY o.id_tec'
            );
            $statement->execute(
                array(
                    ':fecha1' => $fecha1,
                    ':fecha2' => $fecha2
                )
            );

            $codigoHTML = '
            <html>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="css/estilo_reportes.css">
            </head>
            <body>
                <h1 class="titulo_reporte">Reporte Reparaciones de los Tecnicos.</h1>
                <label>Fecha Inicial: '.$fecha1.'</label><br>
                <label>Fecha Final: '.$fecha2.'</label>
                <table>
                    <tr class="primera_fila">
                        <th>Total Reparaciones</th>
                        <th>Nombre del Tecnico</th>
                    </tr>';
                    while($row = $statement->fetch()){
                        $codigoHTML .= "<tr>
                                <td>". $row[0] ."</td>
                                <td>". $row[1] ."</td>
                            </tr>";   
                    }

            $codigoHTML .= '</table>
            </body>
            </html>';


        $codigoHTML = utf8_encode($codigoHTML);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($codigoHTML);
        ini_set("memory_limit","128M");
        $dompdf->render();
        $dompdf->stream("Reparaciones_Tecnicos",array('Attachment'=>0));

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Reporte Tecnicos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Reporte Cantidad de Reparaciones Realizadas</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="fecha_inicial">Fecha Inicial: </label>
                <input type="date" class="form-control" name="fecha_inicial" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="fecha_final">Fecha Final: </label>
                <input type="date" class="form-control" name="fecha_final" value="<?php echo date('Y-m-d'); ?>">
            </div>

            <input type="submit" name="generar" value="Generar Reporte">
        </form>
    </div>


    <script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>