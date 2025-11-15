<?php
session_start();

try {
    include 'functions.php';
    include "class.php";

    $conexion = db_conection('lamp-mariaDB-1', 'db_users', "wdwBSz4uwFblFQ2C", 'health_app');
    if (!isset($_SESSION['islogged']) || !$_SESSION['islogged'] === true) {
        header('Location: index.php');
        exit;
    }
    $paciente = new Paciente($_SESSION["userid"]);
    
} catch (Throwable $ex) {
    /*error_log("Error: " . $ex->getMessage());
    header('Location: error500.php');
    exit();*/
    echo $ex->getMessage();
}
?>
<!--Your code-->

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" href="css/styles.css">-->
    <title>Health App</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div>
        <?php echo $paciente->welcome(); ?>
        <form method="post" action="insertData.php">
            <label>Peso (kg):</label><input type="number" name="peso" />
            <label>Altura (cm):</label><input type="number" name="altura" />
            <input type="submit" />
        </form>
    </div>
    <canvas id="grafica" width="400" height="200"></canvas>
    <script>
        fetch('datos_usuario.php')
            .then(response => response.json())
            .then(data => {
                const fecha = data.map(item => item.fecha);
                const peso = data.map(item => item.peso);
                const altura = data.map(item => item.altura);
                const imc = data.map(item => item.imc);

                new Chart(document.getElementById('grafica'), {
                    type: 'bar',
                    data: {
                        labels: fecha,
                        datasets: [
                            {
                                label: 'Peso',
                                data: peso,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Altura',
                                data: altura,
                                backgroundColor: 'rgba(227, 17, 17, 0.6)',
                                borderColor: 'rgba(227, 17, 17, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'IMC',
                                data: imc,
                                backgroundColor: 'rgba(232, 214, 15, 0.6)',
                                borderColor: 'rgba(243, 223, 3, 0.91)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            });
    </script>
</body>


</html>
