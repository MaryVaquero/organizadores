<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Obra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ccc;
            padding: 10px 20px;
            border-radius: 4px;
            background-color: #4CAF50; /* Color verde */
            color: white; /* Texto blanco */
        }
        .link:hover {
            background-color: #45a049; /* Cambio de color al pasar el ratón */
        }
    </style>
    <script>
        function confirmarEliminacion() {
            return confirm('¿Está seguro de que desea eliminar este registro?');
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Eliminar Obra</h1>
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['confirmar']) && $_POST['confirmar'] == 'Sí') {
                    // Eliminar el registro de la base de datos
                    $sql = "DELETE FROM reporte WHERE id_obra = $id_obra";

                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="message">Registro eliminado exitosamente</div>';
                    } else {
                        echo '<div class="message">Error al eliminar el registro: ' . $conn->error . '</div>';
                    }
                } else {
                    echo '<div class="message">Eliminación cancelada</div>';
                }
            } else {
                echo '<div class="message">Por favor confirme la eliminación:</div>';
                echo '<form action="" method="post" onsubmit="return confirmarEliminacion()">
                        <input type="hidden" name="confirmar" value="Sí">
                        <button type="submit" class="link">Confirmar Eliminación</button>
                      </form>';
            }
        } else {
            echo '<div class="message">ID Obra no proporcionado</div>';
        }

        $conn->close();
        ?>
        <a href="mostrar_datos.php" class="link">Volver a la lista</a>
    </div>
</body>
</html>
