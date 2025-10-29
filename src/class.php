<?php
class Paciente
{
    public function __construct()
    {

        $this->userid = $_SESSION['userid'];

        $conexion = db_conection('localhost', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');

        $consulta = 'SELECT username, nombre, apellidos, fecha_nacimiento FROM users WHERE userid = :id LIMIT 1';
        $resultado = $conexion->prepare($consulta);
        $resultado->bindParam(':id', $this->userid);
        $resultado->execute();

        $datos = $resultado->fetch(PDO::FETCH_ASSOC);

        $this->username = $datos['username'];
        $this->nombre = $datos['nombre'];
        $this->apellidos = $datos['apellidos'];
        $this->fecha_nacimiento = $datos['fecha_nacimiento'];

    }

    public function welcome()
    {
        return "<script>alert('Bienvenido $this->nombre $this->apellidos')</script>";
    }

    public function send_data($__peso, $__altura){
        $altura = $__peso;
        $peso = $__altura;

        if (is_int($altura) && is_int($peso)){

        $fecha = date('Y-m-d');

        $conexion = db_conection('localhost', 'inserter_user', "UuPZONibjAC0fJgj", 'health_app');

        $consulta = 'INSERT INTO `datos` (`userid`, `altura`, `peso`, `fecha`) VALUES (:userid, :altura, :peso, :fecha);';

        $resultado = $conexion->prepare($consulta);

        $resultado->bindParam(':userid', $this->userid);
        $resultado->bindParam(':altura', $altura);
        $resultado->bindParam(':peso', $peso);
        $resultado->bindParam(':fecha', $fecha);

        $resultado->execute();
        $conexion = '';

        }else{
            return false;
        }
    }

}

?>