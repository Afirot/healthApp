document.querySelectorAll(".delete-user").forEach(button => {

    button.addEventListener("click", async function(event){

        event.preventDefault();

        const iduser = this.dataset.id;

        // Confirmación antes de borrar
        const confirmDelete = confirm("¿Estás seguro de que quieres eliminar este usuario?");

        if (!confirmDelete) {
            return;
        }

        try {

            const response = await fetch("../api/admin/delete_user.php", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify({
                    iduser: iduser
                })

            });

            const data = await response.json();

            alert(data);

            // Recargar la página para actualizar la tabla
            location.reload();

        } catch (error) {

            alert("Error de conexión");

        }

    });

});