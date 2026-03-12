<?php
try {
    include 'functions.php';
    include "class.php";
    
    $conexion = db_conection('127.0.0.1', 'db_users', $_ENV['DB_USERS_PASS'], 'health_app');
    if (isset($_COOKIE['token'])) {
        header('Location: main.php');
        exit;
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
    <meta http-equiv="Content-Security-Policy"
        content="
        default-src 'self';
        script-src 'self' 'unsafe-inline' https://www.google.com https://www.gstatic.com;
        style-src 'self' 'unsafe-inline' https://www.gstatic.com;
        img-src 'self' data: https://www.google.com https://www.gstatic.com;
        connect-src 'self' https://www.google.com https://www.gstatic.com;
        frame-src https://www.google.com;
        font-src 'self' https://www.gstatic.com;
        ">
    <link rel="stylesheet" href="css/paneles.css">
    <title>Login - Health App</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfaqWYsAAAAAB6-VarlZVgzz9bj31BLiUe7w6fh"></script>
    <script src="recaptcha.js" defer></script>
    <script src="js/login.js" defer></script>
</head>
<body>
    <div class="login-container">
        <form class="login" id="loginForm">
            <div class="logo-text">
                health<span class="highlight">-app</span>
            </div>
            <h1>Login</h1>
            <label>Usuario</label>
            <div>
                <input type="text" id="nombre" name="nombre" placeholder="Username" required />
            </div>
            <label>Contraseña</label>
            <div>
                <input type="password" id="pass" name="pass" placeholder="Password" required />
            </div>
            <input type="hidden" name="token" id="recaptchaToken" />
            <button type="submit">Login</button>
            <p id="error" style="color:red;"></p>
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
