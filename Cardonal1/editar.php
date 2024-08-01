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

if (isset($_GET['id_obra'])) {
    $id_obra = $_GET['id_obra'];

    // Obtener los datos actuales de la base de datos
    $sql = "SELECT * FROM reporte WHERE id_obra = $id_obra";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontraron registros";
        exit();
    }
} else {
    echo "ID Obra no proporcionado";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $No_Obra = $_POST['No_Obra'];
    $Descripcion = $_POST['Descripcion'];
    $Comunidad = $_POST['Comunidad'];
    $Fecha_Contrato = $_POST['Fecha_Contrato'];
    $Fecha_inicio = $_POST['Fecha_inicio'];
    $Fecha_termino = $_POST['Fecha_termino'];
    $Anticipo_30 = $_POST['Anticipo_30'];
    $Estimacion_1 = $_POST['Estimacion_1'];
    $Estimacion2_Finiquito = $_POST['Estimacion2_Finiquito'];
    $Estimacion_3 = $_POST['Estimacion_3'];
    $Retencion5_Millar = $_POST['Retencion5_Millar'];
    $Retencion1_Insp = $_POST['Retencion1_Insp'];
    $Suma = $_POST['Suma'];
    $Monto = $_POST['Monto'];
    $Diferencia = $_POST['Diferencia'];
    $Estatus = $_POST['Estatus'];

    // Actualizar datos en la base de datos
    $sql = "UPDATE reporte SET 
            No_Obra='$No_Obra', 
            Descripcion='$Descripcion', 
            Comunidad='$Comunidad', 
            Fecha_Contrato='$Fecha_Contrato', 
            Fecha_inicio='$Fecha_inicio', 
            Fecha_termino='$Fecha_termino', 
            Anticipo_30='$Anticipo_30', 
            Estimacion_1='$Estimacion_1', 
            Estimacion2_Finiquito='$Estimacion2_Finiquito', 
            Estimacion_3='$Estimacion_3', 
            Retencion5_Millar='$Retencion5_Millar', 
            Retencion1_Insp='$Retencion1_Insp', 
            Suma='$Suma', 
            Monto='$Monto', 
            Diferencia='$Diferencia', 
            Estatus='$Estatus'
            WHERE id_obra=$id_obra";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Obra</h1>
        <form action="" method="post">
            <label for="No_Obra">No. Obra:</label>
            <input type="text" name="No_Obra" id="No_Obra" value="<?php echo $row['No_Obra']; ?>" required>

            <label for="Descripcion">Descripción:</label>
            <textarea name="Descripcion" id="Descripcion" rows="4" required><?php echo $row['Descripcion']; ?></textarea>

            <label for="Comunidad">Comunidad:</label>
            <input type="text" name="Comunidad" id="Comunidad" value="<?php echo $row['Comunidad']; ?>" required>

            <label for="Fecha_Contrato">Fecha de Contrato:</label>
            <input type="date" name="Fecha_Contrato" id="Fecha_Contrato" value="<?php echo $row['Fecha_Contrato']; ?>" required>

            <label for="Fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="Fecha_inicio" id="Fecha_inicio" value="<?php echo $row['Fecha_inicio']; ?>" required>

            <label for="Fecha_termino">Fecha de Término:</label>
            <input type="date" name="Fecha_termino" id="Fecha_termino" value="<?php echo $row['Fecha_termino']; ?>" required>

            <label for="Anticipo_30">Anticipo 30%:</label>
            <input type="number" step="0.01" name="Anticipo_30" id="Anticipo_30" value="<?php echo $row['Anticipo_30']; ?>" required>

            <label for="Estimacion_1">Estimación 1:</label>
            <input type="number" step="0.01" name="Estimacion_1" id="Estimacion_1" value="<?php echo $row['Estimacion_1']; ?>" required>

            <label for="Estimacion2_Finiquito">Estimación 2 (Finiquito):</label>
            <input type="number" step="0.01" name="Estimacion2_Finiquito" id="Estimacion2_Finiquito" value="<?php echo $row['Estimacion2_Finiquito']; ?>" required>

            <label for="Estimacion_3">Estimación 3:</label>
            <input type="number" step="0.01" name="Estimacion_3" id="Estimacion_3" value="<?php echo $row['Estimacion_3']; ?>" required>

            <label for="Retencion5_Millar">Retención 5 por Millar:</label>
            <input type="number" step="0.01" name="Retencion5_Millar" id="Retencion5_Millar" value="<?php echo $row['Retencion5_Millar']; ?>" required>

            <label for="Retencion1_Insp">Retención 1% Inspección:</label>
            <input type="number" step="0.01" name="Retencion1_Insp" id="Retencion1_Insp" value="<?php echo $row['Retencion1_Insp']; ?>" required>

            <label for="Suma">Suma:</label>
            <input type="number" step="0.01" name="Suma" id="Suma" value="<?php echo $row['Suma']; ?>" required>

            <label for="Monto">Monto:</label>
            <input type="number" step="0.01" name="Monto" id="Monto" value="<?php echo $row['Monto']; ?>" required>

            <label for="Diferencia">Diferencia:</label>
            <input type="number" step="0.01" name="Diferencia" id="Diferencia" value="<?php echo $row['Diferencia']; ?>" required>

            <label for="Estatus">Estatus:</label>
            <input type="text" name="Estatus" id="Estatus" value="<?php echo $row['Estatus']; ?>" required>

            <button type="submit">Actualizar</button>
        </form>
        <a href="mostrar_datos.php">Volver a la lista</a>
    </div>
</body>
</html>
