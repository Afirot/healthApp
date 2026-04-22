<?php
try {
    include 'functions.php';
    include "class.php";
    
    $conexion = db_conection('127.0.0.1', $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);
    if (!isset($_COOKIE['jwt'])) {
        header('Location: index.php');
        exit;
    }
    $jwt = $_COOKIE['jwt'];
    //Aqui vamos a validar el jwt
    $data = jwt_validate($jwt);
    
    if (!$data || !isset($data->id)) {
        die("JWT inválido");
    }
    $userid = $data->id;
    $paciente = new Paciente($userid);

    
} catch (Throwable $ex) {
    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();
}
?>
<!--Your code-->

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="
        default-src 'self';
        script-src 'self' https://cdn.jsdelivr.net;
        connect-src 'self' https://cdn.jsdelivr.net;
        style-src 'self';
        img-src 'self';
        ">
    <title>Health App</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="js/insert_data.js"></script>
</head>

<body>
    <div>
        <?php echo $paciente->welcome(); ?>
        <form class="datos" id="insertData" method="post">
            <div id="error" style="color:red;"></div>
            <label>Peso (kg):</label>
            <input type="number" id="peso" name="peso" />

            <label>Altura (cm):</label>
            <input type="number" id="altura" name="altura" />
            <input type="submit" />
        </form>
    </div>
    <canvas id="grafica" width="400" height="200"></canvas>
    <script src="js/main.js"></script>
</body>
</html>