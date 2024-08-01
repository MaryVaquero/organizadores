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
            padding: 20px; /* Aumento del espacio interno del formulario */
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
            max-width: 500px; /* Reducción del ancho máximo del contenedor */
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
            width: 100%; /* Ancho completo del botón */
            padding: 12px; /* Ajuste del espacio interno del botón */
            background-color: #4CAF50; /* Color verde */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Espacio superior */
        }

        button[type="submit"]:hover {
            background-color: #45a049; /* Cambio de color al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container">
    <center><a href="admin.php">Volver al menu</a>
    </center> 
        <h1>Formulario de Obra</h1>
        <form action="ObraFiscal.php" method="post">
            <label for="numero_oficio">Número de Oficio:</label>
            <input type="text" id="numero_oficio" name="numero_oficio" required>

            <label for="fecha_autorizacion">Fecha de Autorización:</label>
            <input type="date" id="fecha_autorizacion" name="fecha_autorizacion" required>

            <label for="numero_obra">Número de Obra:</label>
            <input type="text" id="numero_obra" name="numero_obra" required>

            <label for="obra">Obra (Descripción):</label>
            <input type="text" id="obra" name="obra" required>

            <label for="localidad">Localidad:</label>
            <input type="text" id="localidad" name="localidad" required>

            <label for="modalidad">Modalidad:</label>
            <input type="text" id="modalidad" name="modalidad" required>

            <label for="monto_autorizado">Monto Autorizado:</label>
            <input type="number" step="0.01" id="monto_autorizado" name="monto_autorizado" required>

            <label for="monto_autorizado">Monto Contratado:</label>
            <input type="number" step="0.01" id="monto_contratado" name="monto_contratado" required>

            <label for="numero_contrato">Número de Contrato:</label>
            <input type="text" id="numero_contrato" name="numero_contrato" required>

            <label for="contratista">Contratista:</label>
            <input type="text" id="contratista" name="contratista" required>

            <label for="supervisor_empresa">Supervisor de Empresa:</label>
            <input type="text" id="supervisor_empresa" name="supervisor_empresa" required>

            <label for="supervisor_obras">Supervisor de Obras:</label>
            <input type="text" id="supervisor_obras" name="supervisor_obras" required>

            <label for="capacitacion_comite">Capacitación de Comité:</label>
            <input type="text" id="capacitacion_comite" name="capacitacion_comite" required>

            <label for="fecha_contrato">Fecha de Contrato:</label>
            <input type="date" id="fecha_contrato" name="fecha_contrato" required>

            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>

            <label for="fecha_termino">Fecha de Término:</label>
            <input type="date" id="fecha_termino" name="fecha_termino" required>

            <label for="observaciones" class="full-width">Observaciones:</label>
            <textarea id="observaciones" name="observaciones" class="full-width"></textarea>

            <button type="submit" class="full-width">Guardar Obra</button>
        </form>
        <form action="mostrar_obra.php" method="get">
        <button type="submit">Mostrar Obras</button>
    </div>
</body>
</html>
