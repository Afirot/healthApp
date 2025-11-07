<?php
session_start();

try {
    include 'functions.php';
    include "class.php";

    $conexion = db_conection('localhost', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
    if (!isset($_SESSION['islogged']) || !$_SESSION['islogged'] === true) {
        header('Location: index.php');
        exit;
    }
    $paciente = new Paciente();
    
} catch (Throwable $ex) {
    /*error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();*/
    echo $ex->getMessage();
}
?>
<!--Your code-->

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="css/styles.css">-->
    <title></title>
</head>

<body>
    <div>
        <?php echo $paciente->welcome(); ?>
        <form method="post" action="insertData.php">
            <label>Peso (kg):</label><input type="number" name="peso"/>
            <label>Altura (cm):</label><input type="number" name="altura"/>
            <input type="submit"/>
        </form>
    </div>
    <div class="grafica">
        <?php
        $datos = $paciente->extract_data();
        
        $tabla = '<table>';
        $tabla .= '<tr>';
        $tabla .= '<th>Peso</th>';
        $tabla .= '<th>Altura</th>';
        $tabla .= '<th>IMC</th>';
        $tabla .= '<th>Fecha</th>';
        $tabla .= '</tr>';
        foreach ($datos as $linea) {
            $imc = ($linea['peso'] / $linea['altura']) ** 2;
            $tabla .= '<tr>';
            $tabla .= '<td>' . number_format($linea['peso'], 2, ',') . ' Kg</td>';
            $tabla .= '<td>' . $linea['altura'] . ' cm</td>';
            $tabla .= '<td>' . number_format($imc, 2) . '</td>';
            $tabla .= '<td>' . $linea['fecha'] . '</td>';
            $tabla .= '</tr>';
        }
        $tabla .= '<table>';
        echo $tabla;
        ?>
    </div>
</body>

</html>
