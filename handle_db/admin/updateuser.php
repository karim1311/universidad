<?php
// Conexión a la base de datos
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

// Comprobar si el formulario fue enviado
if (isset($_POST['update'])) {
    // Obtén los datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];

    // Consulta SQL para actualizar los detalles del usuario
    $sql = "UPDATE usuarios SET correo = :correo, role_id = :rol WHERE usuario_id = :id";
    $stmnt = $pdo->prepare($sql);
    $stmnt->execute(['correo' => $correo, 'rol' => $rol, 'id' => $usuario_id]);

    // Redirigir al usuario a la página de roles
    header("Location: /views/admin/permisos.php");
}
?>
