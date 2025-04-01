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
    // Comprobar que todos los campos necesarios están presentes
    if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['contrasenha'])) {
        // Recoger los datos del formulario
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contrasenha = mysqli_real_escape_string($conn, $_POST['contrasenha']);
        
        // Cifrar la contrasenha
        $contrasenha_hash = password_hash($contrasenha, PASSWORD_DEFAULT);

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, contrasenha) VALUES ('$nombre', '$email', '$contrasenha_hash')";

        if (mysqli_query($conn, $sql)) {
            header("Location: pag_principal.html");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Por favor, completa todos los campos del formulario.";
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>
