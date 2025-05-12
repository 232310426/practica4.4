<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de temperaturas por hora</title>
    <link rel="stylesheet" href="./css/chartist.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./js/chartist.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="centro">
            <h1>Temperaturas tomadas durante el día</h1>
            <span class="subt">Horario: 06:00 a 21:00 del 24 de mayo de 2025</span>
        </div>

        <div class="ct-chart ct-perfect-fourth"></div>

        <?php
        $archivo = './json/tempMyMByHour.json';
        $handle = fopen($archivo, 'r') or die("Error: No se puede abrir el archivo json");
        $contenido = fread($handle, filesize($archivo));
        fclose($handle);

        $listaTemper = json_decode($contenido, true);
        $lista_labels = array_keys($listaTemper);
        $lista_valores = array_values($listaTemper);
        ?>

        <script>
        var datos = {
            labels: [<?php echo "'" . implode("','", $lista_labels) . "'"; ?>],
            series: [{
                name: 'serie-1',
                data: [<?php echo implode(",", $lista_valores); ?>]
            }]
        };

        var opciones = {
            fullWidth: true,
            showArea: true,
            showLine: true,
            showPoint: true,
            chartPadding: {
                bottom: 50,
                right: 35,
                left: 10
            },
            axisX: {
                position: 'start'
            },
            axisY: {
                type: Chartist.FixedScaleAxis,
                ticks: [20, 24, 26, 28, 30, 32, 34, 36, 38],
                low: 20,
                high: 38
            },
            series: {
                'serie-1': {
                    lineSmooth: Chartist.Interpolation.cardinal()
                }
            }
        };

        new Chartist.Line('.ct-chart', datos, opciones);
        </script>
    </div>
</body>
</html>
