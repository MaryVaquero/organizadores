<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['accion'])) {
        switch ($data['accion']) {
            case 'guardar':
                guardarFila($conn, $data);
                break;
            case 'modificar':
                modificarFila($conn, $data);
                break;
            case 'eliminar':
                eliminarFila($conn, $data['id']);
                break;
        }
    }
}

function guardarFila($conn, $data) {
    $sql = "INSERT INTO reporte (id_obra, No_Obra, Descripcion, Comunidad, Fecha_Contrato, Fecha_inicio, Fecha_termino, Anticipo_30%, Estimacion_1, Estimacion2_Finiquito, Estimacion_3, Retencion5_Millar, Retencion1%_Insp, Suma, Monto, Diferencia, Estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssss", $data['id_obra'], $data['No_Obra'], $data['Descripcion'], $data['Comunidad'], $data['Fecha_Contrato'], $data['Fecha_inicio'], $data['Fecha_termino'], $data['Anticipo_30%'], $data['Estimacion_1'], $data['Estimacion2_Finiquito'], $data['Estimacion_3'], $data['Retencion5_Millar'], $data['Retencion1%_Insp'], $data['Suma'], $data['Monto'], $data['Diferencia'], $data['Estatus']);
    $stmt->execute();
    $stmt->close();
    echo json_encode(["message" => "Fila guardada con éxito"]);
}

function modificarFila($conn, $data) {
    // Implementar lógica de modificación
}

function eliminarFila($conn, $id) {
    $sql = "DELETE FROM reporte WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    echo json_encode(["message" => "Fila eliminada con éxito"]);
}
?>
