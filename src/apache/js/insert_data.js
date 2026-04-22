document.getElementById("insertData").addEventListener("submit", async (event) => {
    event.preventDefault();

    const errorElement = document.getElementById("error");

    const showError = (msg) => {
        if (errorElement) {
            errorElement.textContent = msg;
            errorElement.style.opacity = "0.8";
        }
    };

    const clearError = () => {
        if (errorElement) errorElement.textContent = "";
    };

    clearError();

    try {
        const peso = document.getElementById("peso")?.value;
        const altura = document.getElementById("altura")?.value;

        if (!peso || !altura) {
            showError("Datos incompletos.");
            return;
        }

        const response = await fetch("../api/insertData.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ peso, altura })
        });

        if (!response.ok) {
            showError("Error del servidor.");
            return;
        }

        let data;
        try {
            data = await response.json();
        } catch {
            showError("Respuesta inválida del servidor.");
            return;
        }

        if (data?.exito) {
            // transición suave en lugar de redirección brusca
            document.body.style.transition = "opacity 0.4s ease";
            document.body.style.opacity = "0";

            setTimeout(() => {
                window.location.href = "main.php";
            }, 400);

        } else {
            showError(data?.error || "No se pudo completar la operación.");
        }

    } catch {
        showError("Fallo de conexión.");
    }
});