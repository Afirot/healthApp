fetch('../api/datos_usuario.php')
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