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
        <link rel="stylesheet" href="css/paneles.css">
        <title></title>
    </head>
    <body>
        <div class="login-container">
            <form class="login" action="login.php" method="post">
                <div class="logo-text">
                    health<span class="highlight">-app</span>
                </div>
                <h1>Login</h1>
                <label>Usuario</label>
                <div>
                     <input type="text" name="nombre" value=""
                            placeholder="Username"/>
                </div>
                <label>Contraseña</label>
                <div>
                    <input type="password" name="pass" value=""
                           placeholder="Password"/>
                </div>
                <button type="submit">Login</button>
            </form>
            <hr>
            <div class="register-link">
                <form class="registro" action="panelRegistro.php" method="post">
                    <button type="submit">Haz click para registrarte</button>
                </form>
            </div>
        </div>
    </body>
</html>
