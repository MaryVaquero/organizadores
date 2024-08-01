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

// Obtener el ID de la obra a eliminar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Eliminar la obra de la base de datos
    $sql = "DELETE FROM obras WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Obra eliminada correctamente'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar la obra: " . $conn->error . "'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('ID de obra no válido'); window.location.href='index.php';</script>";
}

$conn->close();
?>
