<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presidencia</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

header {
    background-color: #004080;
    color: white;
    padding: 10px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header .logo img {
    height: 50px;
}

nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a, .login-button {
    color: white; /* Cambiar color a blanco para los enlaces y el botón */
    text-decoration: none;
    font-size: 16px;
}

.login-button {
    background-color: #008CBA;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.login-button:hover {
    background-color: #005f6b;
}

.hero {
    position: relative;
    text-align: center;
    color: white; /* Color blanco para el texto en la sección hero */
}

.hero img {
    width: 100%;
    height: auto;
}

.hero-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.hero-text h1 {
    font-size: 50px;
    color: black; /* Color blanco para el texto del h1 en la sección hero */
}

.hero-text p {
    font-size: 20px;
}

.about, .contact {
    padding: 40px;
    text-align: center;
}

footer {
    background-color: #004080;
    color: white;
    text-align: center;
    padding: 10px 0;
}

</style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo Presidencia">
        </div>
        <nav>
            <ul>
                <li><a href="historia.html">Historia</a></li>
                <li><a href="contact.html">Contacto</a></li>
                <li><button class="login-button" onclick="window.location.href='login.php'">Iniciar Sesión</button></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <img src="hero-image.jpg" alt="Imagen Principal">
            <div class="hero-text">
                <h1>Bienvenido a Mohaí Cardonal</h1>
                <p>Trabajando juntos por un mejor país</p>
            </div>

    <footer>
        <p>&copy; 2024 Presidencia. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
