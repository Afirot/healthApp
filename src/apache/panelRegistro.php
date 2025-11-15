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
            <button type="submit"><a>Registrarse<a/></button>
        </form>
    </body>
</html>
