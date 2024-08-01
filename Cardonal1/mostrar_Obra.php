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

// Variables para almacenar criterios de búsqueda
$search_query = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $search_query = " WHERE numero_obra LIKE '%$search%' OR localidad LIKE '%$search%'";
}

// Construir consulta SQL con criterios de búsqueda
$sql = "SELECT * FROM obras" . $search_query;

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
    <title>Mostrar Obras</title>
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
        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
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
    </style>
    <script>
        function confirmarEliminacion(id) {
            if (confirm("¿Estás seguro de que deseas eliminar esta obra?")) {
                window.location.href = "eliminarObra.php?id=" + id;
            }
        }
    </script>
</head>
<body>
    <h1>Datos de Obras Guardadas</h1>
    <div class="container">
    <h2>Buscar Obra</h2>
    <form method="get" action="">
        <label for="search">Buscar por Número de Obra o Localidad:</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <button type="submit">Buscar</button>
    </form>
    </div>

    <table>
        <tr>
            <th>Número de Oficio</th>
            <th>Fecha de Autorización</th>
            <th>Número de Obra</th>
            <th>Obra</th>
            <th>Localidad</th>
            <th>Modalidad</th>
            <th>Monto Autorizado</th>
            <th>Monto Contratado</th>
            <th>Número de Contrato</th>
            <th>Contratista</th>
            <th>Supervisor Empresa</th>
            <th>Supervisor Obras</th>
            <th>Capacitación Comité</th>
            <th>Fecha de Contrato</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Término</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['numero_oficio']}</td>
                        <td>{$row['fecha_autorizacion']}</td>
                        <td>{$row['numero_obra']}</td>
                        <td>{$row['obra']}</td>
                        <td>{$row['localidad']}</td>
                        <td>{$row['modalidad']}</td>
                        <td>$" . number_format($row['monto_autorizado'], 2) . "</td>
                        <td>$" . number_format($row['monto_contratado'], 2) . "</td>
                        <td>{$row['numero_contrato']}</td>
                        <td>{$row['contratista']}</td>
                        <td>{$row['supervisor_empresa']}</td>
                        <td>{$row['supervisor_obras']}</td>
                        <td>{$row['capacitacion_comite']}</td>
                        <td>{$row['fecha_contrato']}</td>
                        <td>{$row['fecha_inicio']}</td>
                        <td>{$row['fecha_termino']}</td>
                        <td>{$row['observaciones']}</td>
                        <td>
                            <a href='editarObra.php?id={$row['id']}'>Editar</a> |
                            <a href='#' onclick='confirmarEliminacion({$row['id']})'>Eliminar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='18'>No hay datos disponibles</td></tr>";
        }
        ?>
    </table>
    <div class="footer">
        <a href="Obras.php">Volver al formulario</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
