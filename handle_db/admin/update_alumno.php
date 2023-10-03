<!-- archivo update_alumno.php -->
<?php
// Conexión a la base de datos
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

// Comprobar si el formulario fue enviado
if (isset($_POST['update'])) {
    // Obtén los datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    // Consulta SQL para actualizar los detalles del usuario
    $sql = "UPDATE usuarios SET usuario_nombre = :nombre, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE usuario_id = :id";
    $stmnt = $pdo->prepare($sql);
    $stmnt->execute(['nombre' => $nombre, 'direccion' => $direccion, 'fecha_nacimiento' => $fecha_nacimiento, 'id' => $usuario_id]);

    // Redirigir al usuario a la página de alumnos
    header("Location: /views/admin/alumnos.php");
}
?>
