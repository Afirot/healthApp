<?php
    // Validacion RECAPTCHA
    $token = $_POST['token'] ?? '';
    $secret = "6LfaqWYsAAAAAL860Lgf8v5XHJpVef8rwAb9bYBH";
    $response = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify" .
        "?secret=$secret&response=$token"
    );
    $result = json_decode($response, true);
    if ($result["success"] && $result["score"] < 0.5) {
        header("Location: /bot.html");
    } else {
        try{
            include 'functions.php';
            //Aqui inicio la conexion, deberiamos buscar una forma de crear esta misma conexion desde un .env por razones de seguridad
            $conexion = db_conection('127.0.0.1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
            //Esta es la consulta
            $consulta = 'SELECT userid, username, hash FROM users WHERE username = :nombre';
            $preparado = $conexion->prepare($consulta);
            $preparado->bindParam(':nombre', $_POST['nombre']);
            $preparado->execute();
            $datos = $preparado->fetch();
            //Esta es la base de la conexion, comprueba si existe un usuario y si hay un hash que coincidaq con la contraseña dentro de la base de datos
            //Los hashes deben codificarse en BCRYPT
            if ($datos && password_verify($_POST['pass'], $datos['hash'])){
                //Aqui se inicia la sesion
                session_start();
                session_regenerate_id(true);
                //Y se almacenan en $_SESSION un verificador de que se encuentra logeado y el id del usuario
                $_SESSION['islogged'] = True;
                $_SESSION['userid'] = $datos['userid'];
                header('location: main.php');
                exit;
            }else{
	            $ip = $_SERVER['REMOTE_ADDR'];
	            $method = $_SERVER['REQUEST_METHOD'];
	            $uri = $_SERVER['REQUEST_URI'];
	            $protocol = $_SERVER['SERVER_PROTOCOL'];
	            $status = 200;
	            $size = 512;
	            $referer =  $_SERVER['HTTP_REFERER'];
	            $userAgent = $_SERVER['HTTP_USER_AGENT'];
	            $fecha = date('d/M/Y:H:i:s O');
	            $log_line = sprintf('%s - - [%s] "%s %s %s" %d %d "%s" "%s"', $ip, $fecha, $method, $uri, $protocol, $status, $size, $referer, $userAgent);
                //En caso de que los datos no sean correctos se reenviara al index.php
	            $log_file = '/var/log/apache/login-log.log';
	            @file_put_contents($log_file, $log_line . PHP_EOL, FILE_APPEND);
                echo '<!DOCTYPE html>
                      <html>
                    <head>
                        <meta http-equiv="refresh" content="0;url=index.php">
                    </head>
                    <body>
                        Si no eres redirigido automáticamente, <a href="index.php">haz clic aquí</a>.
                    </body>
                    </html>';
                exit;
            }
        } catch (Exception $ex){
            error_log("Error: " . $ex->getMessage());
            header('Location: error500.php');
            exit;
            //echo $ex;
        }
    }
?>
