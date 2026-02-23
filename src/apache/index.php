<?php
try {
    include 'functions.php';
    include "class.php";
    
    $conexion = db_conection('127.0.0.1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
    if (isset($_SESSION['jwt'])) {
        header('Location: main.php');
        exit;
    }
    header('location: index.php');

} catch (Throwable $ex) {
    error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" 
      content="default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self';">
    <link rel="stylesheet" href="css/paneles.css">
    <title>Login - Health App</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfaqWYsAAAAAB6-VarlZVgzz9bj31BLiUe7w6fh"></script>
    <script src="recaptcha.js" defer></script>
</head>
<body>
    <div class="login-container">
        <form class="login" onsubmit="onClick(event)" action="login.php" method="post">
            <div class="logo-text">
                health<span class="highlight">-app</span>
            </div>
            <h1>Login</h1>
            <label>Usuario</label>
            <div>
                 <input type="text" name="nombre" placeholder="Username" required />
            </div>
            <label>Contraseña</label>
            <div>
                <input type="password" name="pass" placeholder="Password" required />
            </div>
            <!-- Input oculto para el token reCAPTCHA -->
            <input type="hidden" name="token" id="recaptchaToken" />
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
