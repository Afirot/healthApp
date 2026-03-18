<?php
    try{
        include '../class.php';

        $data = json_decode(file_get_contents("php://input"), true);
              
        $usuario = $data['usuario'] ?? '';
        $nombre = $data['nombre'] ?? '';
        $apellidos = $data['apellidos'] ?? '';
        $fechaNacimiento = $data['fechaNacimiento'] ?? '';
        $pass = $data['pass'] ?? '';
        $pass2 = $data['pass2'] ?? '';

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

        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9\s]).{15,64}$/', $pass)) {
            throw new Exception("Contraseña inválida");
            exit;
        }
    
        $registro = new registro($usuario, $nombre, $apellidos, $fechaNacimiento, $pass, $pass2);
   
        $registro->comprobarPass();
    }catch (Exception $ex){
        echo json_encode(["error" => "Something whet wrong"]);
    }
?>