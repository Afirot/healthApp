<?php
try{
    include 'functions.php';

    //Aqui inicio la conexion, deberiamos buscar una forma de crear esta misma conexion desde un .env por razones de seguridad
    $conexion = db_conection('localhost', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');

    //Esta es la consulta
    $consulta = 'SELECT userid, username, hash FROM users WHERE username = :nombre';

    $preparado = $conexion->prepare($consulta);
    $preparado->bindParam(':nombre', $_POST['nombre']);

    $preparado->execute();

    $datos = $preparado->fetch();

    //Esta es la base de la conexion, comprueba si existe un usuario y si hay un hash que coincidaq con la contraseña dentro de la base de datos
    //Los hashes deben codificarse en BCRYPT
    if ($datos && password_verify($_POST['pass'], $datos['hash'])){

        //Aqui se inicia la sesion
        session_start();
        session_regenerate_id(true);

        //Y se almacenan en $_SESSION un verificador de que se encuentra logeado y el id del usuario
        $_SESSION['islogged'] = True;
        $_SESSION['userid'] = $datos['userid'];

        header('location: main.php');
        exit;
    }else{
        //En caso de que los datos no sean correctos se reenviara al index.php
        header('location: index.php');
        exit;
    }
} catch (Exception $ex){

    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit;
    //echo $ex;
}
?>
