<?php
session_start();

try {
    include '../functions.php';
    include "../class.php";
    
    $data = json_decode(file_get_contents("php://input"), true);
              
    $peso = $data['peso'] ?? '';
    $altura = $data['altura'] ?? '';

    $conexion = db_conection('127.0.0.1', $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
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

echo $paciente->send_data($peso, $altura);

?>