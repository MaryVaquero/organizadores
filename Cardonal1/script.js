function validateLogin() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');

    // Datos de usuario y contraseña correctos
    const validUsername = "Cardonal";
    const validPassword = "cardonal123@";

    // Expresión regular para validar la contraseña
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (username !== validUsername) {
        errorMessage.textContent = "Usuario incorrecto";
        return false;
    }

    if (!passwordRegex.test(password)) {
        errorMessage.textContent = "La contraseña debe contener al menos 8 caracteres, incluyendo letras, números y caracteres especiales";
        return false;
    }

    if (password !== validPassword) {
        errorMessage.textContent = "Contraseña incorrecta";
        return false;
    }

    // Si pasa todas las validaciones
    alert("Inicio de sesión exitoso");
    return true;
}
