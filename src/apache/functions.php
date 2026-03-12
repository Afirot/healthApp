<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
function db_conection($servidor, $usuario, $clave, $database) {
    return new PDO("mysql:host=$servidor;dbname=$database", $usuario, $clave);
}
function jwt_generate($username, $user_id, $rol = "user") {
    $secret_key = $_ENV['SECRET_KEY_JWT'];
    $payload = [
        "iat" => time(),
        "exp" => time() + 3600,
        "data" => [
            "id" => $user_id,
            "username" => $username,
            "rol" => $rol
        ]
    ];
    $jwt = JWT::encode($payload, $secret_key, 'HS256');
    return $jwt;
}
function jwt_validate($jwt){
    $secret_key = $_ENV['SECRET_KEY_JWT'];
    $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
    return($decoded->data);
}
