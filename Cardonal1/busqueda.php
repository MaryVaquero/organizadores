<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Obra</title>
    <style>
        /* Estilos para centrar el título y ajustar bordes de la tabla */
        h1 {
            text-align: center;
        }

        form {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form textarea {
            width: calc(100% - 22px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
    <script>
        function calcularSumaYDiferencia() {
            // Obtener valores de los campos
            const anticipo30 = parseFloat(document.getElementById('Anticipo_30').value.replace('$', '').replace(',', '')) || 0;
            const retencion1Insp = parseFloat(document.getElementById('Retencion1_Insp').value.replace('$', '').replace(',', '')) || 0;
            const monto = parseFloat(document.getElementById('Monto').value.replace('$', '').replace(',', '')) || 0;

            // Calcular suma y diferencia
            const suma = anticipo30 + retencion1Insp;
            const diferencia = monto - suma;

            // Actualizar campos de suma y diferencia
            document.getElementById('Suma').value = '$' + suma.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('Diferencia').value = '$' + diferencia.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }
    </script>
</head>
<body>
    <h1>Registrar Pago de Obra</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pagos1";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Manejar búsqueda
    $search_query = "";
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $conn->real_escape_string($_GET['search']);
        $search_query = "WHERE No_Obra LIKE '%$search%' OR Comunidad LIKE '%$search%'";
    }

    // Manejar el formulario de datos
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener datos del formulario y quitar el signo de pesos
        $No_Obra = $conn->real_escape_string($_POST['No_Obra']);
        $Descripcion = $conn->real_escape_string($_POST['Descripcion']);
        $Comunidad = $conn->real_escape_string($_POST['Comunidad']);
        $Fecha_Contrato = $conn->real_escape_string($_POST['Fecha_Contrato']);
        $Fecha_inicio = $conn->real_escape_string($_POST['Fecha_inicio']);
        $Fecha_termino = $conn->real_escape_string($_POST['Fecha_termino']);
        $Anticipo_30 = floatval(str_replace('$', '', $_POST['Anticipo_30']));
        $Estimacion_1 = floatval(str_replace('$', '', $_POST['Estimacion_1']));
        $Estimacion2_Finiquito = floatval(str_replace('$', '', $_POST['Estimacion2_Finiquito']));
        $Estimacion_3 = floatval(str_replace('$', '', $_POST['Estimacion_3']));
        $Retencion5_Millar = floatval(str_replace('$', '', $_POST['Retencion5_Millar']));
        $Retencion1_Insp = floatval(str_replace('$', '', $_POST['Retencion1_Insp']));
        $Monto = floatval(str_replace('$', '', $_POST['Monto']));
        $Estatus = $conn->real_escape_string($_POST['Estatus']);

        // Calcular la suma y la diferencia
        $Suma = $Anticipo_30 + $Retencion1_Insp;
        $Diferencia = $Monto - $Suma;

        // Insertar datos en la base de datos
        $sql = "INSERT INTO reporte (No_Obra, Descripcion, Comunidad, Fecha_Contrato, Fecha_inicio, Fecha_termino, Anticipo_30, Estimacion_1, Estimacion2_Finiquito, Estimacion_3, Retencion5_Millar, Retencion1_Insp, Suma, Monto, Diferencia, Estatus)
        VALUES ('$No_Obra', '$Descripcion', '$Comunidad', '$Fecha_Contrato', '$Fecha_inicio', '$Fecha_termino', '$Anticipo_30', '$Estimacion_1', '$Estimacion2_Finiquito', '$Estimacion_3', '$Retencion5_Millar', '$Retencion1_Insp', '$Suma', '$Monto', '$Diferencia', '$Estatus')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registro guardado exitosamente</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
    ?>

    <!-- Formulario de búsqueda -->
    <div class="container">
        <h2>Buscar Obra</h2>
        <form action="" method="get">
            <label for="search">Buscar por Nombre de Comunidad o Número de Obra:</label>
            <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <!-- Resultados de la búsqueda -->
    <div class="container">
        <?php
        if ($search_query) {
            $sql = "SELECT * FROM reporte $search_query";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Resultados de la búsqueda</h2>";
                echo "<table>";
                echo "<tr>
                        <th>No. Obra</th>
                        <th>Descripción</th>
                        <th>Comunidad</th>
                        <th>Fecha Contrato</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Término</th>
                        <th>Anticipo 30%</th>
                        <th>Estimación 1</th>
                        <th>Estimación 2 (Finiquito)</th>
                        <th>Estimación 3</th>
                        <th>Retención 5 por Millar</th>
                        <th>Retención 1% Inspección</th>
                        <th>Suma</th>
                        <th>Monto</th>
                        <th>Diferencia</th>
                        <th>Estatus</th>
                      </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['No_Obra']}</td>
                            <td>{$row['Descripcion']}</td>
                            <td>{$row['Comunidad']}</td>
                            <td>{$row['Fecha_Contrato']}</td>
                            <td>{$row['Fecha_inicio']}</td>
                            <td>{$row['Fecha_termino']}</td>
                            <td>${$row['Anticipo_30']}</td>
                            <td>${$row['Estimacion_1']}</td>
                            <td>${$row['Estimacion2_Finiquito']}</td>
                            <td>${$row['Estimacion_3']}</td>
                            <td>${$row['Retencion5_Millar']}</td>
                            <td>${$row['Retencion1_Insp']}</td>
                            <td>${$row['Suma']}</td>
                            <td>${$row['Monto']}</td>
                            <td>${$row['Diferencia']}</td>
                            <td>{$row['Estatus']}</td>
                          </tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No se encontraron resultados.</p>";
            }
        }
        ?>
    </div>
    <!-- Formulario de datos -->
    <div class="container">
        <h2>Registrar Pago de Obra</h2>
        <form action="" method="post" oninput="calcularSumaYDiferencia()">
            <label for="No_Obra">No. Obra:</label>
            <input type="text" name="No_Obra" id="No_Obra" required><br>

            <label for="Descripcion">Descripción:</label>
            <textarea name="Descripcion" id="Descripcion" required></textarea><br>

            <label for="Comunidad">Comunidad:</label>
            <input type="text" name="Comunidad" id="Comunidad" required><br>

            <label for="Fecha_Contrato">Fecha de Contrato:</label>
            <input type="date" name="Fecha_Contrato" id="Fecha_Contrato" required><br>

            <label for="Fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="Fecha_inicio" id="Fecha_inicio" required><br>

            <label for="Fecha_termino">Fecha de Término:</label>
            <input type="date" name="Fecha_termino" id="Fecha_termino" required><br>

            <label for="Anticipo_30">Anticipo 30%:</label>
            <input type="text" name="Anticipo_30" id="Anticipo_30" placeholder="$" required><br>

            <label for="Estimacion_1">Estimación 1:</label>
            <input type="text" name="Estimacion_1" id="Estimacion_1" placeholder="$" required><br>

            <label for="Estimacion2_Finiquito">Estimación 2 (Finiquito):</label>
            <input type="text" name="Estimacion2_Finiquito" id="Estimacion2_Finiquito" placeholder="$" required><br>

            <label for="Estimacion_3">Estimación 3:</label>
            <input type="text" name="Estimacion_3" id="Estimacion_3" placeholder="$" required><br>

            <label for="Retencion5_Millar">Retención 5 por Millar:</label>
            <input type="text" name="Retencion5_Millar" id="Retencion5_Millar" placeholder="$" required><br>

            <label for="Retencion1_Insp">Retención 1% Inspección:</label>
            <input type="text" name="Retencion1_Insp" id="Retencion1_Insp" placeholder="$" required><br>

            <label for="Suma">Suma:</label>
            <input type="text" name="Suma" id="Suma" readonly><br>

            <label for="Monto">Monto:</label>
            <input type="text" name="Monto" id="Monto" placeholder="$" required><br>

            <label for="Diferencia">Diferencia:</label>
            <input type="text" name="Diferencia" id="Diferencia" readonly><br>

            <label for="Estatus">Estatus:</label>
            <input type="text" name="Estatus" id="Estatus" required><br>

            <button type="submit">Guardar</button>
        </form>
    </div>

    <div class="container">
        <form action="mostrar_datos.php" method="get">
            <button type="submit">Mostrar Datos</button>
        </form>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
