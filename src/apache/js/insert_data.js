document.getElementById("insertData").addEventListener("submit", async function(event) {
    event.preventDefault();

    const errorElement = document.getElementById("error");
    errorElement.textContent = "";

    try {
        const peso = document.getElementById("peso").value;
        const altura = document.getElementById("altura").value;

        const response = await fetch("../api/insertData.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                peso,
                altura
            })
        });

        const data = await response.json();

        if (data.exito) {
            window.location.href = "main.php";
        } else {
            alert(data.error);
        }

    } catch (error) {
        errorElement.textContent = "Error de conexión";
    }
});