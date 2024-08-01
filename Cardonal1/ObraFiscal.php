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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario con verificaciones
    $numero_oficio = isset($_POST['numero_oficio']) ? $_POST['numero_oficio'] : '';
    $fecha_autorizacion = isset($_POST['fecha_autorizacion']) ? $_POST['fecha_autorizacion'] : '';
    $numero_obra = isset($_POST['numero_obra']) ? $_POST['numero_obra'] : '';
    $obra = isset($_POST['obra']) ? $_POST['obra'] : '';
    $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : '';
    $modalidad = isset($_POST['modalidad']) ? $_POST['modalidad'] : '';
    $monto_autorizado = isset($_POST['monto_autorizado']) ? $_POST['monto_autorizado'] : '';
    $monto_contratado = isset($_POST['monto_contratado']) ? $_POST['monto_contratado'] : '';
    $numero_contrato = isset($_POST['numero_contrato']) ? $_POST['numero_contrato'] : '';
    $contratista = isset($_POST['contratista']) ? $_POST['contratista'] : '';
    $supervisor_empresa = isset($_POST['supervisor_empresa']) ? $_POST['supervisor_empresa'] : '';
    $supervisor_obras = isset($_POST['supervisor_obras']) ? $_POST['supervisor_obras'] : '';
    $capacitacion_comite = isset($_POST['capacitacion_comite']) ? $_POST['capacitacion_comite'] : '';
    $fecha_contrato = isset($_POST['fecha_contrato']) ? $_POST['fecha_contrato'] : '';
    $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
    $fecha_termino = isset($_POST['fecha_termino']) ? $_POST['fecha_termino'] : '';
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';

    // Limpiar los datos del formulario para evitar inyecciones SQL
    $numero_oficio = $conn->real_escape_string($numero_oficio);
    $fecha_autorizacion = $conn->real_escape_string($fecha_autorizacion);
    $numero_obra = $conn->real_escape_string($numero_obra);
    $obra = $conn->real_escape_string($obra);
    $localidad = $conn->real_escape_string($localidad);
    $modalidad = $conn->real_escape_string($modalidad);
    $monto_autorizado = $conn->real_escape_string($monto_autorizado);
    $monto_contratado = $conn->real_escape_string($monto_contratado);
    $numero_contrato = $conn->real_escape_string($numero_contrato);
    $contratista = $conn->real_escape_string($contratista);
    $supervisor_empresa = $conn->real_escape_string($supervisor_empresa);
    $supervisor_obras = $conn->real_escape_string($supervisor_obras);
    $capacitacion_comite = $conn->real_escape_string($capacitacion_comite);
    $fecha_contrato = $conn->real_escape_string($fecha_contrato);
    $fecha_inicio = $conn->real_escape_string($fecha_inicio);
    $fecha_termino = $conn->real_escape_string($fecha_termino);
    $observaciones = $conn->real_escape_string($observaciones);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO obras (numero_oficio, fecha_autorizacion, numero_obra, obra, localidad, modalidad, monto_autorizado, monto_contratado, numero_contrato, contratista, supervisor_obras, supervisor_empresa, capacitacion_comite, fecha_contrato, fecha_inicio, fecha_termino, observaciones) 
            VALUES ('$numero_oficio', '$fecha_autorizacion', '$numero_obra', '$obra', '$localidad', '$modalidad', '$monto_autorizado', '$monto_contratado, '$numero_contrato', '$contratista', '$supervisor_obras', '$supervisor_empresa', '$capacitacion_comite', '$fecha_contrato', '$fecha_inicio', '$fecha_termino', '$observaciones')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Método de solicitud no permitido";
}

$conn->close();
?>
