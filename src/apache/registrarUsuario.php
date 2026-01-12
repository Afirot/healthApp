<?php
    include 'class.php';
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recibir datos y limpiarlos
    $usuario = trim($_POST['usuario'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';

    $errores = [];

    if (!preg_match('/^[A-Za-z0-9]{2,32}$/', $usuario)) {
        $errores[] = "El nombre de usuario debe contener solo letras y números (2-32 caracteres).";
    }

    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,32}$/', $nombre)) {
        $errores[] = "El nombre debe contener solo letras (2-32 caracteres).";
    }

    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{5,32}$/', $apellidos)) {
        $errores[] = "Los apellidos deben contener solo letras y espacios (5-32 caracteres).";
    }

    if (empty($fechaNacimiento) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaNacimiento)) {
        $errores[] = "La fecha de nacimiento es obligatoria y debe ser válida.";
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $pass)) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.";
    }

    if ($pass !== $pass2) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<p><a href='javascript:history.back()'>Volver</a></p>";
        exit;
    }

    if (!$errores){
        $registro = new registro($_POST['usuario'], $_POST['nombre'],
                                 $_POST['apellidos'], $_POST['fechaNacimiento'],
                                 $_POST['pass'], $_POST['pass2']);
    }
    $registro->comprobarPass();
