<!-- archivo delete_maestro.php -->
<?php
// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtén los datos del formulario
    $usuario_id = $_POST['id'];

    // Conexión a la base de datos
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    // Eliminar las materias asignadas al maestro
    $stmnt = $pdo->prepare("DELETE FROM maestros_materias WHERE maestro_id = :id");
    $stmnt->execute(['id' => $usuario_id]);

    // Luego, eliminar al maestro
    $stmnt = $pdo->prepare("DELETE FROM usuarios WHERE usuario_id = :id");
    $stmnt->execute(['id' => $usuario_id]);


    // Redirigir al usuario a la página de alumnos
    header("Location: /views/admin/maestros.php");
}
?>