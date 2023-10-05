<!-- archivo delete_alumno.php -->
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

if (isset($_POST['id'])) {
    $usuario_id = $_POST['id'];

    // Eliminar al maestro de la tabla maestros_materias
    $comando_eliminar_asignaciones = $pdo->prepare("DELETE FROM maestros_materias WHERE maestro_id = :maestro_id");
    $comando_eliminar_asignaciones->execute(['maestro_id' => $usuario_id]);

    // Eliminar al maestro de la tabla usuarios
    $comando_eliminar_maestro = $pdo->prepare("DELETE FROM usuarios WHERE usuario_id = :usuario_id AND role_id = 2");
    $comando_eliminar_maestro->execute(['usuario_id' => $usuario_id]);
}

// Redirigir al usuario de regreso a la página de maestros
header("Location: /views/admin/maestros.php");
?>