<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Fija el ancho del contenedor para un mejor alineamiento */
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left; /* Alinea las etiquetas y los campos de entrada a la izquierda */
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold; /* Añade negrita a las etiquetas para mejor legibilidad */
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Asegura que el padding no afecte al ancho total */
        }

        button {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Hace que el botón ocupe todo el ancho disponible */
            box-sizing: border-box; /* Asegura que el padding no afecte al ancho total */
        }

        button:hover {
            background-color: #003366;
        }

        #error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" onsubmit="return validateLogin()">
            <div class="input-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
            <p id="error-message"></p>
        </form>
    </div>
    <script>
        function validateLogin() {
            // Aquí puedes agregar la validación que desees
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('error-message');

            if (username === "Cardonal" && password === "cardonal123@") {
                // Redirigir a otra página si las credenciales son correctas
                window.location.href = "admin.php";
                return false; // Prevenir el envío del formulario
            } else {
                errorMessage.textContent = "Usuario o contraseña incorrectos.";
                return false; // Prevenir el envío del formulario
            }
        }
    </script>
</body>
</html>
