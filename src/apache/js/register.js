document.getElementById("registerForm").addEventListener("submit", async function(event) {
    event.preventDefault();

    const errorElement = document.getElementById("error");
    errorElement.textContent = "";

    try {
        const usuario = document.getElementById("usuario").value;
        const nombre = document.getElementById("nombre").value;
        const apellidos = document.getElementById("apellidos").value;
        const fechaNacimiento = document.getElementById("fechaNacimiento").value;
        const pass = document.getElementById("pass").value;
        const pass2 = document.getElementById("pass2").value;

        const response = await fetch("../api/registro.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                usuario,
                nombre,
                apellidos,
                fechaNacimiento,
                pass,
                pass2
            })
        });

        const data = await response.json();

        if (data.exito) {
            window.location.href = "index.php";
        } else {
            alert(data.error);
        }

    } catch (error) {
        errorElement.textContent = "Error de conexión";
    }
});