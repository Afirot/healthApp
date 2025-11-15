<?php

use PHPUnit\Framework\TestCase;

include "/var/www/html/health-app/functions.php";
require_once "/var/www/html/health-app/class.php";

class PacienteTest extends TestCase{

    /*
    Pruebas unitarias del construct

    ID de usuario valido (aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY) -- Los valores username, nombre, etc tienen valor
    ID de usuario no valido ('idNoValido') -- Los valores username, nombre, etc NO tienen valor
    Bool (True) -- Los valores username, nombre, etc NO tienen valor
    NULL (null) -- Los valores username, nombre, etc NO tienen valor
    Ningun valor () -- PDOException
    */
    public function testPacienteIdValido(){
        $paciente = new Paciente('aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY');
        $this->assertNotNull($paciente->username, "El username no debería ser null");
        $this->assertNotNull($paciente->nombre, "El nombre no debería ser null");
        $this->assertNotNull($paciente->apellidos, "Los apellidos no deberían ser null");
        $this->assertNotNull($paciente->fecha_nacimiento, "La fecha de nacimiento no debería ser null");
    }
    public function testPacienteIdInvalido()
    {
        $paciente = new Paciente('idNoValido');
        $this->assertNull($paciente->username, "El username debería ser null");
        $this->assertNull($paciente->nombre, "El nombre debería ser null");
        $this->assertNull($paciente->apellidos, "Los apellidos deberían ser null");
        $this->assertNull($paciente->fecha_nacimiento, "La fecha de nacimiento debería ser null");
    }
    public function testPacienteBool()
    {
        $paciente = new Paciente(True);
        $this->assertNull($paciente->username, "El username debería ser null");
        $this->assertNull($paciente->nombre, "El nombre debería ser null");
        $this->assertNull($paciente->apellidos, "Los apellidos deberían ser null");
        $this->assertNull($paciente->fecha_nacimiento, "La fecha de nacimiento debería ser null");
    }
    public function testPacienteVacio()
    {
        $this->expectException(ArgumentCountError::class);
        $paciente = new Paciente();
    }

    public function testPacienteNull()
    {
        $paciente = new Paciente(null);
        $this->assertNull($paciente->username, "El username debería ser null");
        $this->assertNull($paciente->nombre, "El nombre debería ser null");
        $this->assertNull($paciente->apellidos, "Los apellidos deberían ser null");
        $this->assertNull($paciente->fecha_nacimiento, "La fecha de nacimiento debería ser null");
    }

    /*Pruebas unitarias de send_data*/
    /*
    Valores int validos (100, 100) -- True
    Valores int no validos (-100, -100) -- False
    Valores string ('Hola', 'Caracola') -- False
    Valores bool (True, True) -- False
    Valores float (33.33, 66.66) -- False
    */

    public function testPacienteSend_dataIntValido(){
        $paciente = new Paciente('aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY');
        $this->assertEquals(True, $paciente->send_data(100,100), "Se espera un True");
    }

    public function testPacienteSend_dataIntInvalido(){
        $paciente = new Paciente('aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY');
        $this->assertEquals(False, $paciente->send_data(-100,-100), "Se espera un False");
    }
    public function testPacienteSend_dataString(){
        $paciente = new Paciente('aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY');
        $this->assertEquals(False, $paciente->send_data('Hola', 'Caracola'), "Se espera un False");
    }

    public function testPacienteSend_dataBool(){
        $paciente = new Paciente('aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY');
        $this->assertEquals(False, $paciente->send_data(True, False), "Se espera un False");
    }

    public function testPacienteSend_dataFloat(){
        $paciente = new Paciente('aB3dE9fG1hJ6kL0mN2pQ4rS7tU8vW5xY');
        $this->assertEquals(False, $paciente->send_data(33.33, 66.66), "Se espera un False");
    }

    /*NO se han realizado tests a la funcion extract_data debido a que para que se ejecute debe de haber en el constructo un id de usuario valido, 
    por lo tanto es redundante*/

    
}