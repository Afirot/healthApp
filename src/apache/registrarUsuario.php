<?php
    include 'class.php';
    
    $registro = new registro($_POST['usuario'], $_POST['nombre'],
                             $_POST['apellidos'], $_POST['fechaNacimiento'],
                             $_POST['pass'], $_POST['pass2']);
    
    $registro->comprobarPass();
