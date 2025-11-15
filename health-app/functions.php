<?php

function db_conection($servidor, $usuario, $clave, $database) {
    return new PDO("mysql:host=$servidor;dbname=$database", $usuario, $clave);
}
