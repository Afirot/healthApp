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
</body>

</html>
