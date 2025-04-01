<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$basededatos = "expo_edu";
$usuario = "root";
$contrasenha_bd = "";

// Crear la conexión
$conn = mysqli_connect($servername, $usuario, $contrasenha_bd, $basededatos);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contrasenha = mysqli_real_escape_string($conn, $_POST['contrasenha']);

    // Buscar al usuario por el correo electrónico
    $sql = "SELECT id, nombre, contrasenha FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        // El usuario existe
        $usuario = mysqli_fetch_assoc($resultado);

        // Verificar la contraseña
        if (password_verify($contrasenha, $usuario['contrasenha'])) {
            // Contraseña correcta
            // Redirigir al usuario a la página principal (por ejemplo, "index.php")
            header("Location: pag_principal.html");
            exit(); // Asegúrate de llamar a exit() después de header() para evitar que el código siga ejecutándose
        } else {
            // Contraseña incorrecta
            echo "La contrasenha es incorrecta.";
        }
    } else {
        // El usuario no existe
        echo "No se encontró un usuario con ese correo electrónico.";
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>
