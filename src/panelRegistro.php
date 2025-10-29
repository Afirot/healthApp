<?php
try {
    session_start();
    if (isset($_SESSION['islogged'])) {
        header('location: home.php');
    }
} catch (Throwable $ex) {
    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <!--<link rel="stylesheet" href="css/styles.css">-->
        <title></title>
    </head>
    <body>
        <form class="registro" action="resgistrarUsuario.php" method="post">
            <h1>Registro</h1>
            <label>Usuario</label>
            <div>
                 <input type="text" name="usuario" value="" placeholder="Username"/>
            </div>
            <label>Nombre</label>
            <div>
                 <input type="text" name="nombre" value="" placeholder="Name"/>
            </div>
            <label>Apellidos</label>
            <div>
                 <input type="text" name="apellidos" value="" placeholder="Surname"/>
            </div>
            <label>Nombre</label>
            <div>
                 <input type="text" name="nombre" value="" placeholder="Name"/>
            </div>
            <label>Contraseña</label>
            <div>
                <input type="password" name="pass" value="" placeholder="Password"/>
            </div>
            <label>Repite la contraseña</label>
            <div>
                <input type="password" name="pass2" value="" placeholder="Password"/>
            </div>
            <button type="submit">Registrarse</button>
        </form>
    </body>
</html>