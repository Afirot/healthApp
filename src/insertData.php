<?php
session_start();

try {
    include 'functions.php';

    $conexion = db_conection('localhost', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
    if (!isset($_SESSION['islogged']) || !$_SESSION['islogged'] === true) {
        header('Location: index.php');
        exit;
    }
    $idUsuario = $_SESSION['userid'];

    $consulta = 'SELECT username FROM users WHERE userid = :id LIMIT 1';
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':id', $idUsuario);
    $resultado->execute();
    $conexion = '';
} catch (Throwable $ex) {
    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();
}

$altura = $_POST['altura'];
$peso = $_POST['peso'];

$fecha = date('Y-m-d');

$conexion = db_conection('localhost', 'inserter_user', "UuPZONibjAC0fJgj", 'health_app');

$consulta = 'INSERT INTO `datos` (`userid`, `altura`, `peso`, `fecha`) VALUES (:userid, :altura, :peso, :fecha);';

$resultado = $conexion->prepare($consulta);

$resultado->bindParam(':userid', $idUsuario);
$resultado->bindParam(':altura', $altura);
$resultado->bindParam(':peso', $peso);
$resultado->bindParam(':fecha', $fecha);

$resultado->execute();

header('Location: main.php');
exit();
?>