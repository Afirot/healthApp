document.getElementById("registerForm").addEventListener("submit", async function(event) {

    event.preventDefault();

    const errorElement = document.getElementById("error");

    errorElement.textContent = "";

    try {

        grecaptcha.ready(async function() {

            /*const recaptchaToken = await grecaptcha.execute(
                '6LfaqWYsAAAAAB6-VarlZVgzz9bj31BLiUe7w6fh',
                {action: 'login'}
            );*/

            const nombre = document.getElementById("nombre").value;
            const pass = document.getElementById("pass").value;

            console.log(nombre);
            console.log(pass);

            const response = await fetch("../api/login.php", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify({
                    nombre: nombre,
                    pass: pass,
                    //token: recaptchaToken
                })

            });

            const data = await response.json();

            if (data.jwt) {

                document.cookie = "jwt=" + data.jwt + "; path=/; Secure; SameSite=Strict";
                window.location.href = "main.php";

            } else {

                alert(data.error);

            }

        });

    } catch (error) {

        //console.error("Error en login:", error);
        errorElement.textContent = "Error de conexión";

    }

});