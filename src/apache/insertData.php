<?php
session_start();

try {
    include 'functions.php';
    include "class.php";
    
    $conexion = db_conection('127.0.0.1', 'db_users', $_ENV['DB_USERS_PASS'], 'health_app');
    if (!isset($_COOKIE['jwt'])) {
        header('Location: index.php');
        exit;
    }
    $jwt = $_COOKIE['jwt'];
    //Aqui vamos a validar el jwt
    $data = jwt_validate($jwt);

    $userid = $data->id;
    $paciente = new Paciente($userid);

} catch (Throwable $ex) {
    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();
}

$paciente->send_data($_POST['peso'], $_POST['altura']);

header('Location: main.php');
exit();
?>


