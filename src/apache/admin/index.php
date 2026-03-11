<?php

try {
    include '../functions.php';
    include "../class.php";
    
    $conexion = db_conection('127.0.0.1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
    if (!isset($_COOKIE['jwt'])) {
        header('Location: ../index.php');
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

$jwt = $_COOKIE['jwt'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://localhost/api/admin/get_users.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Cookie: jwt=$jwt"
]);

$response = curl_exec($ch);
curl_close($ch);

$users = json_decode($response, true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy"
        content="
        default-src 'self';
        script-src 'self' 'unsafe-inline' https://www.google.com https://www.gstatic.com;
        style-src 'self' 'unsafe-inline' https://www.gstatic.com;
        img-src 'self' data: https://www.google.com https://www.gstatic.com;
        connect-src 'self' https://www.google.com https://www.gstatic.com;
        frame-src https://www.google.com;
        font-src 'self' https://www.gstatic.com;
        ">
    <title>Login - Health App</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfaqWYsAAAAAB6-VarlZVgzz9bj31BLiUe7w6fh"></script>
    <script src="../recaptcha.js" defer></script>
    <script src="../js/delete_user.js" defer></script>
</head>
<body>
    <div>
        <table border=1>
            <tr>
                <th>Username</th><th>Nombre</th><th>Apellidos</th><th>Rol</th>
            </tr>
            <?php
                foreach ($users as $user){
                    $username = htmlspecialchars($user['username']);
                    $nombre = htmlspecialchars($user['nombre']);
                    $apellidos = htmlspecialchars($user['apellidos']);
                    $rol = htmlspecialchars($user['rol']);
                    $userid = $user['userid'];
                    echo "<tr><td>$username</td><td>$nombre</td><td>$apellidos</td><td>$rol</td><td><a href='#' class='delete-user' data-id='$userid'>Delete User</a></td></tr>";
                }
                ?>
        </table>
    </div>
</body>
</html>