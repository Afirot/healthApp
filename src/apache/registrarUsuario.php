<?php
include 'class.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = trim($_POST['usuario'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';


    if (!preg_match('/^[A-Za-z0-9]{2,32}$/', $usuario)) {
        throw new Exception("Username invalido");
        exit;
    }

    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,32}$/', $nombre)) {
        throw new Exception("Nombre inválido");
        exit;
    }

    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,32}$/', $apellidos)) {
        throw new Exception("Apellido inválido");
        exit;
    }

    if (empty($fechaNacimiento) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaNacimiento)) {
        throw new Exception("Fecha inválida");
        exit;
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9\s]).{8,}$/', $pass)) {
        throw new Exception("Contraseña inválida");
        exit;
    }
    
    $registro = new registro($_POST['usuario'], $_POST['nombre'],
    $_POST['apellidos'], $_POST['fechaNacimiento'],
    $_POST['pass'], $_POST['pass2']);
    
    $registro->comprobarPass();
}
