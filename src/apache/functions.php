<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
function db_conection($servidor, $usuario, $clave, $database) {
    return new PDO("mysql:host=$servidor;dbname=$database", $usuario, $clave);
}
function jwt_generate($username, $user_id, $rol = "user") {
    $secret_key = "a8f3c9e6d2b7415f9a6c8e3d1f0b2a497c5e8d3a9f1b6c2d4e7f8a9b0c3d5e6"; //Clave de prueba, debemos hacer que se genere aleatoriamente al iniciar el docker o usar RSA
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
    $secret_key = "a8f3c9e6d2b7415f9a6c8e3d1f0b2a497c5e8d3a9f1b6c2d4e7f8a9b0c3d5e6"; //Clave de prueba, debemos hacer que se genere aleatoriamente al iniciar el docker o usar RSA
    $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
    return($decoded->data);
}
