document.getElementById("registerForm").addEventListener("submit", async function(event) {

    event.preventDefault();

    const errorElement = document.getElementById("error");

    errorElement.textContent = "";

    try {

        /*grecaptcha.ready(async function() {*/

            /*const recaptchaToken = await grecaptcha.execute(
                '6LfaqWYsAAAAAB6-VarlZVgzz9bj31BLiUe7w6fh',
                {action: 'login'}
            );*/

        const usuario = document.getElementById("usuario").value;
        const nombre = document.getElementById("nombre").value;
        const apellidos= document.getElementById("apellidos").value;
        const fechaNacimiento= document.getElementById("fechaNacimiento").value;
        const pass= document.getElementById("pass").value;
        const pass2 = document.getElementById("pass2").value;

        console.log(usuario);
        console.log(nombre);
        console.log(apellidos);
        console.log(fechaNacimiento);
        console.log(pass);
        console.log(pass2);

        const response = await fetch("../api/registro.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                usuario: usuario,
                nombre: nombre,
                apellidos: apellidos,
                fechaNacimiento: fechaNacimiento,
                pass: pass,
                pass2: pass2
            })
        });
    } catch (error){
        //console.error("Error en login:", error);
        errorElement.textContent = "Error de conexión";
    }
})