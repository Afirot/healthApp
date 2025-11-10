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
        return "<script>alert('Bienvenido " . htmlspecialchars($this->nombre) . " " . htmlspecialchars($this->apellidos) . "')</script>";
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
public function extract_data()
    {
        $fecha = date('Y-m-d');

        $conexion = db_conection('localhost', 'lector_datos', "pT9g!uJ4mX2s@Qf", 'health_app');

        $consulta = 'SELECT peso, altura, fecha FROM datos WHERE userid = :userid;';

        $resultado = $conexion->prepare($consulta);

        $resultado->bindParam(':userid', $this->userid);

        $resultado->execute();
        $conexion = '';

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php
    class registro{
        private $usuario;
        public $pass;
        public $pass2;
        private function __construct($usuario_,$pass_,$pass2_) {
            $registro->usuario=$usuario_;
            $registro->pass=$pass_;
            $registro->pass2=$pass2_;
        }
        function comprobarPass(){
            if($registro->pass != $registro->pass2){
                while(True){
                    $salida='<html>
                             <head>
                             <meta charset="UTF-8">
                                <!--<link rel="stylesheet" href="css/styles.css">-->
                                <title></title>
                             </head>
                             <body>
                                 <form class="registro" action="resgistrarUsuario.php" method="post">
                                     <h1>Login</h1>
                                     <label>Usuario</label>
                                     <div>
                                        <input type="text" name="nombre" value="" placeholder="Username"/>
                                     </div>
                                         <label>Contraseña</label>
                                     <div>
                                         <input type="password" name="pass" value="" placeholder="Password"/>
                                     </div>
                                    
                                     <label>Repite la contraseña</label>                                    
                                     <div>
                                        <input type="password" name="pass2" value="" placeholder="Password"/>
                                     </div>';
                    return $salida;
                }
            }
        }
    public function extract_data()
    {
        $fecha = date('Y-m-d');

        $conexion = db_conection('localhost', 'lector_datos', "pT9g!uJ4mX2s@Qf", 'health_app');

        $consulta = 'SELECT peso, altura, fecha FROM datos WHERE userid = :userid;';

        $resultado = $conexion->prepare($consulta);

        $resultado->bindParam(':userid', $this->userid);

        $resultado->execute();
        $conexion = '';

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}
class registro{
    private $usuario;
    private $pass;
    private $pass2;
    private $nombre;
    private $apellidos;
    private $fechaNacimiento;
    
    public function __construct($usuario_, $nombre_, $apellidos_, $fechaNacimiento_,
                                $pass_, $pass2_){
        $this->usuario=$usuario_;
        $this->pass=$pass_;
        $this->pass2=$pass2_;
        $this->nombre=$nombre_;
        $this->apellidos=$apellidos_;
        $this->fechaNacimiento=$fechaNacimiento_;
    }
    function insertarUsuario(){
        $dsn = 'mysql:host=localhost;dbname=health_app';
        $usuario = 'inserter_user';
        $clave = 'UuPZONibjAC0fJgj';
        
        try {
            $conexion = new PDO($dsn,$usuario,$clave);
            $consulta = 'INSERT INTO (username,hash,nombre,apellidos,
                         fecha_nacimiento)
                         VALUES(:username,:hash,:nombre,:apellidos,
                         :fechaNacimiento)';
            $resultado = $conexion->prepare($consulta);
            
            $hash = password_hash($this->pass, PASSWORD_BCRYPT);
            
            $resultado->bindParam(':username', $this->usuario);
            $resultado->bindParam(':hash', $hash);
            $resultado->bindParam(':nombre', $this->nombre);
            $resultado->bindParam(':apellidos', $this->apellidos);
            $resultado->bindParam(':fechaNacimiento', $this->apellidos);
            
            header("Location: index.php?registro=exitoso");
            exit;
        }catch (PDOException $exception){
            echo "Fallo de conexión ", $exception->getmessage();
        }
    }
    function comprobarUsuario(){
        $dsn = "mysql:host=localhost;dbname=health_app";
        $usuario = "inserter_user";
        $clave = "UuPZONibjAC0fJgj";
        
        try {
            $conexion = new PDO($dsn,$usuario,$clave);
            $consulta = 'SELECT *
                         FROM users
                         WHERE username = ?';
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(1, $this->usuario, PDO::PARAM_STR);
            $resultado->execute();

            if ($resultado->rowCount() > 0){
                $salida='<!DOCTYPE html>
                         <html>
                             <head>
                                 <meta charset="UTF-8">
                                 <!--<link rel="stylesheet" href="css/styles.css">-->
                                 <title></title>
                             </head>
                             <body>
                                 <form class="registro" action="registrarUsuario.php" method="post">
                                     <h1>Registro</h1>
                                     <br>
                                     <h1>El usuario introducido ya existe, por favor introduzca uno distinto</h1>
                                     <br>
                                     <label>Usuario</label>
                                     <div>
                                         <input type="text" name="usuario" id="usuario" value=""
                                                title="El nombre del usuario debe contener solo letras 
                                                       y números"
                                                pattern="[A-Za-z0-9]{2,32}"
                                                required/>
                                     </div>
                                     <br>
                                     <label>Nombre</label>
                                     <div>
                                          <input type="text" name="nombre" id="nombre" value=""
                                                 title="El nombre debe contener solo letras"
                                                 pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,32}" title="" required/>
                                     </div>
                                     <br>
                                     <label>Apellidos</label>
                                     <div>
                                          <input type="text" name="apellidos" id="apellidos" value=""
                                                 title="Los apellidos deben contener solo letras"
                                                 pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{5,32}"
                                                 required/>
                                     </div>
                                     <br>
                                     <label>Fecha de Nacimiento</label>
                                     <div>
                                          <input type="date" name="fechaNacimiento" id="fechaNacimiento"
                                                 value=""
                                                 title="La fecha de nacimiento del paciente es
                                                        obligatorio"
                                                 required/>
                                     </div>
                                     <br>
                                     <label>Contraseña</label>
                                     <div>
                                         <input type="password" name="pass" id="pass"
                                                pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$"
                                                value=""
                                                title="La contraseña debe contener mínimo 8 caracteres,
                                                       al menos una letra mayúscula y un caracter
                                                       especial"
                                                required/>
                                     </div>
                                     <br>
                                     <label>Repite la contraseña</label>
                                     <div>
                                         <input type="password" name="pass2" id="pass2"
                                                pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$"
                                                value=""
                                                title="Debe introducir la contraseña de nuevo
                                                       obligatoriamente"
                                                required/>
                                     </div>
                                     <br>
                                     <button type="submit">Registrarse</button>
                                 </form>
                             </body>
                         </html>';
                echo $salida;
            } else {
                $this->insertarUsuario();
            }
        }catch (PDOException $exception){
            echo "Fallo de conexión ", $exception->getmessage();
        }
    }
    
    function comprobarPass(){
        if($this->pass !== $this->pass2){
            $salida='<!DOCTYPE html>
                     <html>
                         <head>
                             <meta charset="UTF-8">
                             <link rel="stylesheet" href="css/paneles.css">
                             <title></title>
                         </head>
                         <body>
                             <form class="registro" action="registrarUsuario.php" method="post">
                                 <h1>Registro</h1>
                                 <br>
                                 <label>Usuario</label>
                                 <div>
                                     <input type="text" name="usuario" id="usuario" value=""
                                            title="El nombre del usuario debe contener solo letras 
                                                   y números"
                                            pattern="[A-Za-z0-9]{2,32}"
                                            required/>
                                 </div>
                                 <br>
                                 <label>Nombre</label>
                                 <div>
                                      <input type="text" name="nombre" id="nombre" value=""
                                             title="El nombre debe contener solo letras"
                                             pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,32}" title="" required/>
                                 </div>
                                 <br>
                                 <label>Apellidos</label>
                                 <div>
                                      <input type="text" name="apellidos" id="apellidos" value=""
                                             title="Los apellidos deben contener solo letras"
                                             pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{5,32}"
                                             required/>
                                 </div>
                                 <br>
                                 <label>Fecha de Nacimiento</label>
                                 <div>
                                      <input type="date" name="fechaNacimiento" id="fechaNacimiento"
                                             value=""
                                             title="La fecha de nacimiento del paciente es
                                                    obligatorio"
                                             required/>
                                 </div>
                                 <br>
                                 <h1>Las contraseñas introducidas no son iguales, por favor introduzcalas de nuevo</h1>
                                 <br>
                                 <label>Contraseña</label>
                                 <div>
                                     <input type="password" name="pass" id="pass"
                                            pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$"
                                            value=""
                                            title="La contraseña debe contener mínimo 8 caracteres,
                                                   al menos una letra mayúscula y un caracter
                                                   especial"
                                            required/>
                                 </div>
                                 <br>
                                 <label>Repite la contraseña</label>
                                 <div>
                                     <input type="password" name="pass2" id="pass2"
                                            pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$"
                                            value=""
                                            title="Debe introducir la contraseña de nuevo
                                                   obligatoriamente"
                                            required/>
                                 </div>
                                 <br>
                                 <button type="submit">Registrarse</button>
                             </form>
                         </body>
                     </html>';
            echo $salida;
        }else{
            $this->comprobarUsuario();
        }
    }
}

