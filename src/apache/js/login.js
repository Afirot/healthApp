document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");
    if (!loginForm) return;
    
    loginForm.addEventListener("submit", async function(event) {
        event.preventDefault();

        const errorElement = document.getElementById("error");
        if (errorElement) errorElement.textContent = "";

        try {
            const nombre = document.getElementById("nombre").value;
            const pass = document.getElementById("pass").value;

            console.log(nombre, pass);

            const response = await fetch("../api/login.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ nombre, pass })
            });

            const data = await response.json();

            if (data.jwt) {
                document.cookie = "jwt=" + data.jwt + "; path=/; SameSite=Strict";
                window.location.href = "main.php";
            } else {
                alert(data.error);
            }
        } catch (error) {
            if (errorElement) errorElement.textContent = "Error de conexión";
        }
    });
});