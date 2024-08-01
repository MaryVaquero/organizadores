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

// Obtener el ID de la obra a editar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener los datos actuales de la obra
$sql = "SELECT * FROM obras WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $obra = $result->fetch_assoc();
} else {
    die("Obra no encontrada");
}

// Actualizar los datos si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_oficio = $_POST['numero_oficio'];
    $fecha_autorizacion = $_POST['fecha_autorizacion'];
    $numero_obra = $_POST['numero_obra'];
    $obra_nombre = $_POST['obra'];
    $localidad = $_POST['localidad'];
    $modalidad = $_POST['modalidad'];
    $monto_autorizado = $_POST['monto_autorizado'];
    $monto_contratado = $_POST['monto_contratado'];
    $numero_contrato = $_POST['numero_contrato'];
    $contratista = $_POST['contratista'];
    $supervisor_empresa = $_POST['supervisor_empresa'];
    $supervisor_obras = $_POST['supervisor_obras'];
    $capacitacion_comite = $_POST['capacitacion_comite'];
    $fecha_contrato = $_POST['fecha_contrato'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_termino = $_POST['fecha_termino'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE obras SET
                numero_oficio = '$numero_oficio',
                fecha_autorizacion = '$fecha_autorizacion',
                numero_obra = '$numero_obra',
                obra = '$obra_nombre',
                localidad = '$localidad',
                modalidad = '$modalidad',
                monto_autorizado = '$monto_autorizado',
                monto_contratado = '$monto_contratado',
                numero_contrato = '$numero_contrato',
                contratista = '$contratista',
                supervisor_empresa = '$supervisor_empresa',
                supervisor_obras = '$supervisor_obras',
                capacitacion_comite = '$capacitacion_comite',
                fecha_contrato = '$fecha_contrato',
                fecha_inicio = '$fecha_inicio',
                fecha_termino = '$fecha_termino',
                observaciones = '$observaciones'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Obra actualizada correctamente";
    } else {
        echo "Error al actualizar la obra: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Obra</title>
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

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="date"],
        form input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        form button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Editar Obra</h1>
    <form method="POST" action="">
        <div>
            <label for="numero_oficio">Número de Oficio:</label>
            <input type="text" id="numero_oficio" name="numero_oficio" value="<?php echo $obra['numero_oficio']; ?>" required>
        </div>
        <div>
            <label for="fecha_autorizacion">Fecha de Autorización:</label>
            <input type="date" id="fecha_autorizacion" name="fecha_autorizacion" value="<?php echo $obra['fecha_autorizacion']; ?>" required>
        </div>
        <div>
            <label for="numero_obra">Número de Obra:</label>
            <input type="text" id="numero_obra" name="numero_obra" value="<?php echo $obra['numero_obra']; ?>" required>
        </div>
        <div>
            <label for="obra">Obra:</label>
            <input type="text" id="obra" name="obra" value="<?php echo $obra['obra']; ?>" required>
        </div>
        <div>
            <label for="localidad">Localidad:</label>
            <input type="text" id="localidad" name="localidad" value="<?php echo $obra['localidad']; ?>" required>
        </div>
        <div>
            <label for="modalidad">Modalidad:</label>
            <input type="text" id="modalidad" name="modalidad" value="<?php echo $obra['modalidad']; ?>" required>
        </div>
        <div>
            <label for="monto_autorizado">Monto Autorizado:</label>
            <input type="number" id="monto_autorizado" name="monto_autorizado" value="<?php echo $obra['monto_autorizado']; ?>" required>
        </div>
        <div>
            <label for="monto_contratado">Monto Contratado:</label>
            <input type="number" id="monto_contratado" name="monto_contratado" value="<?php echo $obra['monto_contratado']; ?>" required>
        </div>
        <div>
            <label for="numero_contrato">Número de Contrato:</label>
            <input type="text" id="numero_contrato" name="numero_contrato" value="<?php echo $obra['numero_contrato']; ?>" required>
        </div>
        <div>
            <label for="contratista">Contratista:</label>
            <input type="text" id="contratista" name="contratista" value="<?php echo $obra['contratista']; ?>" required>
        </div>
        <div>
            <label for="supervisor_empresa">Supervisor Empresa:</label>
            <input type="text" id="supervisor_empresa" name="supervisor_empresa" value="<?php echo $obra['supervisor_empresa']; ?>" required>
        </div>
        <div>
            <label for="supervisor_obras">Supervisor Obras:</label>
            <input type="text" id="supervisor_obras" name="supervisor_obras" value="<?php echo $obra['supervisor_obras']; ?>" required>
        </div>
        <div>
            <label for="capacitacion_comite">Capacitación Comité:</label>
            <input type="text" id="capacitacion_comite" name="capacitacion_comite" value="<?php echo $obra['capacitacion_comite']; ?>" required>
        </div>
        <div>
            <label for="fecha_contrato">Fecha de Contrato:</label>
            <input type="date" id="fecha_contrato" name="fecha_contrato" value="<?php echo $obra['fecha_contrato']; ?>" required>
        </div>
        <div>
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $obra['fecha_inicio']; ?>" required>
        </div>
        <div>
            <label for="fecha_termino">Fecha de Término:</label>
            <input type="date" id="fecha_termino" name="fecha_termino" value="<?php echo $obra['fecha_termino']; ?>" required>
        </div>
        <div>
            <label for="observaciones">Observaciones:</label>
            <input type="text" id="observaciones" name="observaciones" value="<?php echo $obra['observaciones']; ?>" required>
        </div>
        <button type="submit">Guardar Cambios</button>
    </form>
    <div class="footer">
        <a href="mostrar_obra.php">Volver al formulario</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
