<?php

try {
    include '../../functions.php';
    include "../../class.php";
    
    $conexion = db_conection('127.0.0.1', $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
    if (!isset($_COOKIE['jwt'])) {
        header('Location: ../../index.php');
        exit;
    }
    $jwt = $_COOKIE['jwt'];
    //Aqui vamos a validar el jwt
    $data = jwt_validate($jwt);
    
    if (!$data || !isset($data->id)) {
        die("JWT inválido");
    }
    if ($data->rol != "admin") {
        die("Only admins");
    }
    $userid = $data->id;
    $paciente = new Paciente($userid);

    $consulta = "SELECT username, nombre, apellidos, userid, rol FROM users";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');

    echo json_encode($datos);
    
} catch (Throwable $ex) {
    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();
}

