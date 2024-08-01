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
            width: 90%;
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
            width: 95%;
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
    <h1>Formulario de Obra</h1>

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
        // Obtener datos del formulario sin quitar el signo de pesos
        $No_Obra = $conn->real_escape_string($_POST['No_Obra']);
        $Descripcion = $conn->real_escape_string($_POST['Descripcion']);
        $Comunidad = $conn->real_escape_string($_POST['Comunidad']);
        $Fecha_Contrato = $conn->real_escape_string($_POST['Fecha_Contrato']);
        $Fecha_inicio = $conn->real_escape_string($_POST['Fecha_inicio']);
        $Fecha_termino = $conn->real_escape_string($_POST['Fecha_termino']);
        $Anticipo_30 = $_POST['Anticipo_30'];  // Mantener el formato con el signo de pesos
        $Estimacion_1 = $_POST['Estimacion_1'];  // Mantener el formato con el signo de pesos
        $Estimacion2_Finiquito = $_POST['Estimacion2_Finiquito'];  // Mantener el formato con el signo de pesos
        $Estimacion_3 = $_POST['Estimacion_3'];  // Mantener el formato con el signo de pesos
        $Retencion5_Millar = $_POST['Retencion5_Millar'];  // Mantener el formato con el signo de pesos
        $Retencion1_Insp = $_POST['Retencion1_Insp'];  // Mantener el formato con el signo de pesos
        $Monto = $_POST['Monto'];  // Mantener el formato con el signo de pesos
        $Estatus = $conn->real_escape_string($_POST['Estatus']);

       // Solo para cálculos específicos, convierte los valores a formato numérico si es necesario
       $Anticipo_30_num = floatval(str_replace('$', '', $Anticipo_30));
       $Estimacion_1_num = floatval(str_replace('$', '', $Estimacion_1));
       $Estimacion2_Finiquito_num = floatval(str_replace('$', '', $Estimacion2_Finiquito));
       $Estimacion_3_num = floatval(str_replace('$', '', $Estimacion_3));
       $Retencion5_Millar_num = floatval(str_replace('$', '', $Retencion5_Millar));
       $Retencion1_Insp_num = floatval(str_replace('$', '', $Retencion1_Insp));
       $Monto_num = floatval(str_replace('$', '', $Monto));
 
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

// Obtener todos los datos de la tabla
$sql = "SELECT * FROM reporte";

// Verificar si hay parámetros de búsqueda
$search_query = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $search_query = " WHERE No_Obra LIKE '%$search%' OR Comunidad LIKE '%$search%'";
    $sql .= $search_query;
}

$result = $conn->query($sql);

// Verificar si la consulta se ejecutó correctamente
if (!$result) {
    die("Error al ejecutar la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Datos de Pagos de Obras</h1>
    <table>
        <tr>
            <th>ID Obra</th>
            <th>No. Obra</th>
            <th>Descripción</th>
            <th>Comunidad</th>
            <th>Fecha de Contrato</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Término</th>
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
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_obra']}</td>
                        <td>{$row['No_Obra']}</td>
                        <td>{$row['Descripcion']}</td>
                        <td>{$row['Comunidad']}</td>
                        <td>{$row['Fecha_Contrato']}</td>
                        <td>{$row['Fecha_inicio']}</td>
                        <td>{$row['Fecha_termino']}</td>
                        <td>$" . number_format($row['Anticipo_30'], 2) . "</td>
                        <td>$" . number_format($row['Estimacion_1'], 2) . "</td>
                        <td>$" . number_format($row['Estimacion2_Finiquito'], 2) . "</td>
                        <td>$" . number_format($row['Estimacion_3'], 2) . "</td>
                        <td>$" . number_format($row['Retencion5_Millar'], 2) . "</td>
                        <td>$" . number_format($row['Retencion1_Insp'], 2) . "</td>
                        <td>$" . number_format($row['Suma'], 2) . "</td>
                        <td>$" . number_format($row['Monto'], 2) . "</td>
                        <td>$" . number_format($row['Diferencia'], 2) . "</td>
                        <td>{$row['Estatus']}</td>
                        <td>
                            <a href='editar.php?id_obra={$row['id_obra']}'>Editar</a> |
                            <a href='eliminar.php?id_obra={$row['id_obra']}'>Eliminar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='18'>No hay datos disponibles</td></tr>";
        }
        ?>
    </table>
    <div class="footer">
        <a href="reportePagos.php">Volver al formulario</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>

