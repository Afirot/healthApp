<?php

use PHPUnit\Framework\TestCase;
require_once "/var/www/html/health-app/class.php";

class registroTest extends TestCase {

    /*Registro valido (Usuario nuevo y dos contraseñas iguales) ('Zafrilla1843', 'Manolo', 'Zafra', '10-10-1945', Contraseca1234, Contraseca1234) -- False*/
    public function testComprobarPassregistroValido() {
        $registro = new Registro('Zafrilla1843', 'Manolo', 'Zafra', '10-10-1945', 'Contraseca1234*', 'Contraseca1234*');

        $this->assertEquals(True, $registro->comprobarPass());
    }
    public function testComprobarUsuarioregistroValido() {
        $registro = new Registro('Zafrilla1843', 'Manolo', 'Zafra', '10-10-1945', 'Contraseca1234*', 'Contraseca1234*');

        $this->assertEquals(True, $registro->comprobarUsuario());
    }

    public function testInsertarUsuarioregistroValido() {
        $registro = new Registro('Zafrilla1843', 'Manolo', 'Zafra', '10-10-1945', 'Contraseca1234*', 'Contraseca1234*');

        $this->assertEquals(True, $registro->insertarUsuario());
    }

    /*Contraseñas Desiguales (Usuario nuevo y dos contraseñas iguales) ('Zafrilla1843', 'Manolo', 'Zafra', '10-10-1945', Contraseca1234, OtraContraseña) -- False*/

    public function testComprobarPassPassDifer() {
        $registro = new Registro('Zafrilla1843', 'Manolo', 'Zafra', '10-10-1945', 'Contraseca1234*', 'OtraContraseña');

        $this->assertEquals(False, $registro->comprobarPass());
    }

    /*Contraseñas Desiguales (Usuario Existente) ('ignacio', 'Manolo', 'Zafra', '10-10-1945', Contraseca1234, OtraContraseña) -- False*/

    public function testComprobarUsuarioUserExists() {
        $registro = new Registro('ignacio', 'Manolo', 'Zafra', '10-10-1945', 'Contraseca1234*', 'Contraseca1234*');

        $this->assertEquals(False, $registro->comprobarUsuario());
    }
}
