<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: url('hero-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .content h1 {
            font-size: 3em;
            margin: 0;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            text-align: center;
            position: fixed;
            width: 60%; /* Ajusta el ancho del fondo negro */
            top: 60%; /* Ajusta la posición del menú */
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px; /* Añade bordes redondeados */
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="content">
        <div>
            <h1>Bienvenido Administrador</h1>
        </div>
    </div>
    <nav>
        <ul>
            <li><a href="reportePagos.php">Reporte de pagos</a></li>
            <li><a href="obras.php">Obras Ejercicio Fiscal</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li> <!-- Enlace de cerrar sesión -->
        </ul>
    </nav>
</body>
</html>
