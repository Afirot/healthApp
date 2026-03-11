<?php

try {
    include '../../functions.php';
    include "../../class.php";
    
    $conexion = db_conection('127.0.0.1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
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
        die("No eres administrador");
    }
    $userid = $data->id;
    $paciente = new Paciente($userid);

    
} catch (Throwable $ex) {
    /*error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();*/
    echo $ex->getMessage();
}

try{
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['iduser'] ?? '';
    $consulta = "DELETE FROM users WHERE userid = :id";
    $resultado = $conexion->prepare($consulta);
    $resultado->bindParam(':id', $id);
    $resultado->execute();

    $mensaje = "Usuario eliminado con exito";

    header('Content-Type: application/json');

    echo json_encode($mensaje);
    
}catch (Throwable $ex) {
    $mensaje = "$ex";

    header('Content-Type: application/json');
    echo json_encode($mensaje);
}