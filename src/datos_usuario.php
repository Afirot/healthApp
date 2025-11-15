<?php
session_start();

try {
    include 'functions.php';
    include "class.php";

    $conexion = db_conection('lamp-mariaDB-1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
    if (!isset($_SESSION['islogged']) || !$_SESSION['islogged'] === true) {
        header('Location: index.php');
        exit;
    }
    $paciente = new Paciente($_SESSION["userid"]);
    
} catch (Throwable $ex) {
    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();
}

$datos = $paciente->extract_data();

header('Content-Type: application/json');

echo json_encode($datos);

?>