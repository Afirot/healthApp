# API JSON
## API datos_usuario.php
Se ha modificado el fichero datos_usuario.php y se ha transformado en api/datos_usuario.php.
```php
<?php
session_start();

header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; connect-src 'self'; frame-ancestors 'none';");

try {
    include '../functions.php';
    include "../class.php";
    
    $conexion = db_conection('127.0.0.1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
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

$datos = $paciente->extract_data();

header('Content-Type: application/json');

echo json_encode($datos);

?>
````

Este programa simplemente extrae los datos del usuario al que perteneze el jwt validado en forma de un json.

Estos datos se extraen en la pagina web a traves del script main.js.
```js
fetch('../api/datos_usuario.php')
    .then(response => response.json())
    .then(data => {
        const fecha = data.map(item => item.fecha);
        const peso = data.map(item => item.peso);
        const altura = data.map(item => item.altura);
        const imc = data.map(item => item.imc);

        new Chart(document.getElementById('grafica'), {
            type: 'bar',
            data: {
                labels: fecha,
                datasets: [
                    {
                        label: 'Peso',
                        data: peso,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Altura',
                        data: altura,
                        backgroundColor: 'rgba(227, 17, 17, 0.6)',
                        borderColor: 'rgba(227, 17, 17, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'IMC',
                        data: imc,
                        backgroundColor: 'rgba(232, 214, 15, 0.6)',
                        borderColor: 'rgba(243, 223, 3, 0.91)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
```
Este script simplemente extrae el json de la base de datos y los representa en forma de una tabla, la parte importante para nuestra implementacion es esta.
```js
fetch('../api/datos_usuario.php')
    .then(response => response.json())
    .then(data => {
        const fecha = data.map(item => item.fecha);
        const peso = data.map(item => item.peso);
        const altura = data.map(item => item.altura);
        const imc = data.map(item => item.imc);
```
Esta sección del codigo extrae el json de la api y lo organiza en sus propias constantes.

## API login.php
Se ha modificado por completo el codigo del anterior login.php, el codigo, ahora, en lugar de asignar la sessión directamente, sin embargo, ahora, tomara los datos de un json y devolbera el resultado en forma de un json, ya sea el token jwt o un codigo de error.
```php
<?php
    // Validacion RECAPTCHA
    $data = json_decode(file_get_contents("php://input"), true);
    $token  = $data['token'] ?? '';
    $secret = "6LfaqWYsAAAAAL860Lgf8v5XHJpVef8rwAb9bYBH";
    $response = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify" .
        "?secret=$secret&response=$token"
    );
    $result = json_decode($response, true);
    if ($result["success"] && $result["score"] < 0.5) {
        header("Location: ../bot.html");
    } else {
        try{
            include '../functions.php';
            //Aqui inicio la conexion, deberiamos buscar una forma de crear esta misma conexion desde un .env por razones de seguridad
            $conexion = db_conection('127.0.0.1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
            //Esta es la consulta
            $data = json_decode(file_get_contents("php://input"), true);
            $nombre = $data['nombre'] ?? '';
            $pass   = $data['pass'] ?? '';
            $consulta = 'SELECT userid, username, hash FROM users WHERE username = :nombre';
            $preparado = $conexion->prepare($consulta);
            $preparado->bindParam(':nombre', $nombre);
            $preparado->execute();
            $datos = $preparado->fetch();

            
            //Esta es la base de la conexion, comprueba si existe un usuario y si hay un hash que coincidaq con la contraseña dentro de la base de datos
            //Los hashes deben codificarse en BCRYPT
            if ($datos && password_verify($pass, $datos['hash'])){
                $jwt = jwt_generate($datos['username'], $datos['userid']);
                header('Content-Type: application/json');
                echo json_encode(["jwt" => $jwt]);
            }else{
	            $ip = $_SERVER['REMOTE_ADDR'];
	            $method = $_SERVER['REQUEST_METHOD'];
	            $uri = $_SERVER['REQUEST_URI'];
	            $protocol = $_SERVER['SERVER_PROTOCOL'];
	            $status = 200;
	            $size = 512;
	            $referer = $_SERVER['HTTP_REFERER'] ?? '-';
	            $userAgent = $_SERVER['HTTP_USER_AGENT'];
	            $fecha = date('d/M/Y:H:i:s O');
	            $log_line = sprintf('%s - - [%s] "%s %s %s" %d %d "%s" "%s"', $ip, $fecha, $method, $uri, $protocol, $status, $size, $referer, $userAgent);
                //En caso de que los datos no sean correctos se reenviara al index.php
	            $log_file = '/var/log/apache/login-log.log';
                header('Content-Type: application/json');
	            @file_put_contents($log_file, $log_line . PHP_EOL, FILE_APPEND);
                echo json_encode(["error" => "Invalid Credentials"]);
            }
        } catch (Exception $ex){
            echo json_encode(["error" => "Something whet wrong"]);
        }
    //}
?>
```

Ahora, el codigo tomara los datos del post enviado en forma de un json con las credenciales.
```php
$data = json_decode(file_get_contents("php://input"), true);
$nombre = $data['nombre'] ?? '';
$pass = $data['pass'] ?? '';
```
Luego hara las validara, exactamente igual que se hacia en las anteriores versiones.
```php
if ($datos && password_verify($pass, $datos['hash'])){
    $jwt = jwt_generate($datos['username'], $datos['userid']);
    header('Content-Type: application/json');
```
Y dara la respuesta en forma de un json, devolbiendo el jwt o un mensaje de error, dependiendo del resultado de validación.
```php
echo json_encode(["jwt" => $jwt]);//Credenciales validas
echo json_encode(["error" => "Invalid Credentials"]);//Credenciales invalidas
echo json_encode(["error" => "Something whet wrong"]);//Error
```