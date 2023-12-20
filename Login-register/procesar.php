<?php
// Archivo: procesar.php
$usuario = "root";
$password = "";
$servidor = "localhost";
$basededatos = "login_db";

// Conexión a la base de datos
$conn = new mysqli($servidor, $usuario, $password, $basededatos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicia la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['id_usuario'])) {
    $idUsuarioAutenticado = $_SESSION['id_usuario'];

    // Obtener el identificador del usuario de la variable $_GET
    $identificador = isset($_GET['id']) ? $_GET['id'] : $idUsuarioAutenticado;

    // Verificar si el formulario se ha enviado y procesar la actualización
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoge los datos del formulario
        $idUsuario = $_POST['id-usuario'];
        $nombreCompleto = $_POST['nombre'];
        $fechaNacimiento = $_POST['fecha-nacimiento'];
        $rubro = $_POST['rubro'];
        $correo = $_POST['correo'];
        $nuevaContrasena = $_POST['contrasena'];

        // Hash de la nueva contraseña
        $hashedPassword = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        // Actualiza la información del usuario en la base de datos
        $sql = "UPDATE usuarios SET 
                nombre = ?,
                fecha_nacimiento = ?,
                rubro = ?,
                correo = ?,
                contrasena = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombreCompleto, $fechaNacimiento, $rubro, $correo, $hashedPassword, $idUsuario);

        if ($stmt->execute()) {
            // Éxito: Usuario actualizado correctamente
            header("Location: home.php");
            exit();
        } else {
            // Error: Error al actualizar usuario
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Error al actualizar usuario: ' . $stmt->error . '",
                    });
                  </script>';
        }

        // Cierra la conexión
        $stmt->close();
    }
} else {
    // Redirige o toma alguna acción si el usuario no ha iniciado sesión
    header("Location: login.php"); // Por ejemplo, redirige a la página de inicio de sesión
    exit();
}

// Cierra la conexión
$conn->close();
?>
