<?php
class Paciente
{
    public $userid;
    public $username;
    public $nombre;
    public $apellidos;
    public $fecha_nacimiento;
    public function __construct($sessionid__)
    {
        $this->userid = $sessionid__;

        $conexion = db_conection('127.0.0.1', $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);

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
        try{
            $altura = (int)$__altura;
            $peso = (int)$__peso;
        }catch(Exception $e){
            return false;
        }
        
        if (is_int($altura) && is_int($peso) && $altura > 0 && $peso > 0){

        $fecha = date('Y-m-d');

        $conexion = db_conection('127.0.0.1', $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);

        $consulta = 'INSERT INTO `datos` (`userid`, `altura`, `peso`, `fecha`) VALUES (:userid, :altura, :peso, :fecha);';

        $resultado = $conexion->prepare($consulta);

        $resultado->bindParam(':userid', $this->userid);
        $resultado->bindParam(':altura', $altura);
        $resultado->bindParam(':peso', $peso);
        $resultado->bindParam(':fecha', $fecha);

        $resultado->execute();
        $conexion = '';
        return true;

        }else{
            return false;
        }
    }
    public function extract_data()
    {
        $fecha = date('Y-m-d');

        $conexion = db_conection('127.0.0.1', $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);

        $consulta = 'SELECT peso, altura, fecha FROM datos WHERE userid = :userid;';

        $resultado = $conexion->prepare($consulta);

        $resultado->bindParam(':userid', $this->userid);

        $resultado->execute();
        

        $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($filas as &$fila) {
            if (!empty($fila['altura']) && !empty($fila['peso'])) {
                $altura_m = $fila['altura'] / 100;
                $fila['imc'] = round($fila['peso'] / ($altura_m * $altura_m), 2);
            } else {
                $fila['imc'] = null;
            }
        }
        $conexion = null;

        return $filas;
    }

}
class registro{
    private $usuario;
    private $pass;
    private $pass2;
    private $nombre;
    private $apellidos;
    private $fechaNacimiento;
    
    public function __construct($usuario_, $nombre_, $apellidos_, $fechaNacimiento_, $pass_, $pass2_){
        $this->usuario=$usuario_;
        $this->pass=$pass_;
        $this->pass2=$pass2_;
        $this->nombre=$nombre_;
        $this->apellidos=$apellidos_;
        $this->fechaNacimiento=$fechaNacimiento_;
    }
    function generarHexAleatorio($longitud) {
        // 32 caracteres hexadecimales = 16 bytes
        $bytes = random_bytes($longitud / 2);
        return bin2hex($bytes);
    }
    function insertarUsuario(){
    $database = $_ENV['MYSQL_DATABASE'];
    $dsn = "mysql:host=127.0.0.1;dbname=$database";
    $usuario = $_ENV['MYSQL_USER'];
    $clave = $_ENV['MYSQL_PASSWORD'];
    
    try {
        $conexion = new PDO($dsn,$usuario,$clave);

        $consulta = 'INSERT INTO users 
                     (userid, username, hash, nombre, apellidos, fecha_nacimiento)
                     VALUES (:userid, :username, :hash, :nombre, :apellidos, :fechaNacimiento)';
        
        $resultado = $conexion->prepare($consulta);

        $hex = $this->generarHexAleatorio(32);
        $hash = password_hash($this->pass, PASSWORD_ARGON2I, ['memory_cost' => 1<<17, 'time_cost' => 4, 'threads' => 2]);

        $resultado->bindParam(':userid', $hex);
        $resultado->bindParam(':username', $this->usuario);
        $resultado->bindParam(':hash', $hash);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->bindParam(':apellidos', $this->apellidos);
        $resultado->bindParam(':fechaNacimiento', $this->fechaNacimiento);

        $resultado->execute();

        $salida=json_encode(["exito" => "El usuario ha sido creado."]);
        echo $salida;
        exit;

        } catch (PDOException $exception){
            echo "Fallo de conexión: ", $exception->getMessage();
            return false;
        }
    }

    function comprobarUsuario(){
        $database = $_ENV['MYSQL_DATABASE'];
        $dsn = "mysql:host=127.0.0.1;dbname=$database";
        $usuario = $_ENV['MYSQL_USER'];
        $clave = $_ENV['MYSQL_PASSWORD'];
        
        try {
            $conexion = new PDO($dsn,$usuario,$clave);
            $consulta = 'SELECT *
                         FROM users
                         WHERE username = ?';
            $resultado = $conexion->prepare($consulta);
            $resultado->bindParam(1, $this->usuario, PDO::PARAM_STR);
            $resultado->execute();

            if ($resultado->rowCount() > 0){
                $salida=json_encode(["error" => "El usuario ya existe."]);
                echo $salida;
                return False;
            } else {
                $this->insertarUsuario();
                return True;
            }
        }catch (PDOException $exception){
            echo "Fallo de conexión ", $exception->getmessage();
        }
    }

    function passwordPwned(){
        $hash = strtoupper(sha1($this->pass));
        $prefix = substr($hash, 0, 5);
        $suffix = substr($hash, 5);

        $url = "https://api.pwnedpasswords.com/range/$prefix";

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_HTTPHEADER => [
                'User-Agent: MyApp Password Checker'
            ],
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $paginaPwned = json_encode(["error" => "La contraseña usada ha sido encontrada en bases de datos filtradas"]);

        if ($response === false) {
            throw new Exception("Error al consultar HIBP");
        }

        foreach (explode("\n", $response) as $line) {
            [$hashSuffix, $count] = explode(':', trim($line));
            if ($hashSuffix === $suffix) {
                echo $paginaPwned;
                return false;
            }
        }
            
        $this->comprobarUsuario();
        return True;
    }

    function comprobarPass(){
        if($this->pass !== $this->pass2){
            $salida=json_encode(["error" => "Las contraseñas deben ser iguales"]);
            echo $salida;
            return False;
        }else{
            $this->passwordPwned();
            return True;
        }
    }
}