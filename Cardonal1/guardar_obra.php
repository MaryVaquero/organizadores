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

// Obtener datos del formulario
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

// Insertar datos en la base de datos
$sql = "INSERT INTO reporte (No_Obra, Descripcion, Comunidad, Fecha_Contrato, Fecha_inicio, Fecha_termino, Anticipo_30, Estimacion_1, Estimacion2_Finiquito, Estimacion_3, Retencion5_Millar, Retencion1_Insp, Suma, Monto, Diferencia, Estatus)
VALUES ('$No_Obra', '$Descripcion', '$Comunidad', '$Fecha_Contrato', '$Fecha_inicio', '$Fecha_termino', '$Anticipo_30', '$Estimacion_1', '$Estimacion2_Finiquito', '$Estimacion_3', '$Retencion5_Millar', '$Retencion1_Insp', '$Suma', '$Monto', '$Diferencia', '$Estatus')";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
